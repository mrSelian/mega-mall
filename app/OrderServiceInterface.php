<?php

namespace App;

interface OrderServiceInterface
{
    function create(Cart $cart);
}
