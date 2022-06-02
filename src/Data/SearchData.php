<?php

namespace App\Data;

use App\Entity\Category;
use App\Entity\Ambiance;

class SearchData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var Category[]
     */
    public $categories = [];

    /**
     * @var Ambiance[]
     */
    public $ambiances = [];
}