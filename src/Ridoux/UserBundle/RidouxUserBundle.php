<?php

namespace Ridoux\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RidouxUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
