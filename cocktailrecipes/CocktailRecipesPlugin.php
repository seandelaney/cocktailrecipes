<?php

namespace Craft;

class CocktailRecipesPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Cocktail Recipes');
    }

    public function getVersion()
    {
        return '2.0';
    }

    public function getDeveloper()
    {
    	// Taken to version 2.0 by Sean Delaney | DelaneyMethod
    	
        return 'Adrian Macneil';
    }

    public function getDeveloperUrl()
    {
        return 'http://adrianmacneil.com';
    }
    
    public function hasCpSection()
    {
        return true;
    }

    /**
     * Register control panel routes
     */
    public function registerCpRoutes()
    {
        return array(
            'cocktailrecipes\/ingredients\/new' => 'cocktailrecipes/ingredients/_edit',
            'cocktailrecipes\/ingredients\/(?P<ingredientId>\d+)' => 'cocktailrecipes/ingredients/_edit',
        );
    }

    /**
     * Register twig extension
     */
    public function addTwigExtension()
    {
        Craft::import('plugins.cocktailrecipes.twigextensions.CocktailRecipesTwigExtension');

        return new CocktailRecipesTwigExtension();
    }

    /**
     * Add default ingredients after plugin is installed
     */
    public function onAfterInstall()
    {
        $ingredients = array(
            array('name' => 'Gin'),
            array('name' => 'Tonic'),
            array('name' => 'Lime'),
            array('name' => 'Soda'),
            array('name' => 'Vodka'),
        );

        foreach ($ingredients as $ingredient) {
            craft()->db->createCommand()->insert('cocktailrecipes_ingredients', $ingredient);
        }
    }
}
