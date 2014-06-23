<?php

namespace Craft;

use Mockery as m;
use PHPUnit_Framework_TestCase;

class CocktailRecipes_IngredientsFieldTypeTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->fieldtype = new CocktailRecipes_IngredientsFieldType();

        // inject service dependencies
        $this->cocktailRecipes_ingredients = m::mock('Craft\CocktailRecipes_IngredientsService');
        $this->cocktailRecipes_ingredients->shouldReceive('getIsInitialized')->andReturn(true);
        craft()->setComponent('cocktailRecipes_ingredients', $this->cocktailRecipes_ingredients);

        $this->templates = m::mock('Craft\TemplatesService');
        $this->templates->shouldReceive('getIsInitialized')->andReturn(true);
        craft()->setComponent('templates', $this->templates);
    }

    public function testGetName()
    {
        $result = $this->fieldtype->getName();

        $this->assertInternalType('string', $result);
        $this->assertNotEmpty($result);
    }

    public function testGetInputHtml()
    {
        $this->cocktailRecipes_ingredients->shouldReceive('getAllIngredients')->once()->andReturn(array());

        $this->templates->shouldReceive('render')->once();
    }
}
