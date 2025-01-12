<?php


namespace SilverStripe\GraphQL\Tests\Schema\DataObject;

use SilverStripe\Dev\TestOnly;
use SilverStripe\GraphQL\Schema\DataObject\InterfaceBuilder;
use SilverStripe\GraphQL\Schema\Type\ModelType;

class FakeInterfaceBuilder extends InterfaceBuilder implements TestOnly
{
    public static $createCalls = [];
    public static $baseCalled = false;
    public static $applyCalls = [];

    public static function reset()
    {
        FakeInterfaceBuilder::$createCalls = [];
        FakeInterfaceBuilder::$baseCalled = false;
        FakeInterfaceBuilder::$applyCalls = [];
    }

    public function createInterfaces(ModelType $modelType, array $interfaceStack = []): InterfaceBuilder
    {
        static::$createCalls[$modelType->getName()] = true;
        return $this;
    }

    public function applyBaseInterface(): InterfaceBuilder
    {
        static::$baseCalled = true;
        return $this;
    }

    public function applyInterfacesToQueries(ModelType $type): InterfaceBuilder
    {
        FakeInterfaceBuilder::$applyCalls[$type->getName()] = true;
        return $this;
    }
}
