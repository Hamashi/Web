<?php
namespace Ridoux\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="Ridoux\AdminBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="url", type="string", length=255)
   */
  private $url;

  /**
   * @ORM\Column(name="alt", type="string", length=255)
   */
  private $alt;
  
  
  private $file;
  private $tempFilename;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
	
	public function getFile()
	{
		return $this->file;
	}
	
	public function setFile(UploadedFile $file)
	{
		$this->file = $file;

		if (null !== $this->url)
		{
			$this->tempFilename = $this->url;
			$this->url = 'noImage';
			$this->alt = 'noImage';

		}

  }


 /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */

  public function preUpload()

  {
    if (null === $this->file) {
      	$this->url = 'noImage';
		$this->alt = 'noImage';
    }
	
    $this->url = $this->file->guessExtension();
    $this->alt = $this->file->getClientOriginalName();
  }


  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */

  public function upload()
  {
    if (null === $this->file) 
	{
      return;
    }

    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    $this->file->move(
      $this->getUploadRootDir(), 
      $this->id.'.'.$this->url   
    );

  }


  /**
   * @ORM\PreRemove()
   */

  public function preRemoveUpload()
  {
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */

  public function removeUpload()
  {
    if (file_exists($this->tempFilename)) {
      unlink($this->tempFilename);
    }
  }


  public function getUploadDir()

  {
    return 'uploads/img';

  }


  protected function getUploadRootDir()

  {

    return __DIR__.'/../../../../web/'.$this->getUploadDir();

  }
}