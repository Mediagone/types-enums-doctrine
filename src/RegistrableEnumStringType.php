<?php declare(strict_types=1);

namespace Mediagone\Doctrine\Types\Enums;

use Doctrine\DBAL\Types\Type;
use LogicException;
use Mediagone\Types\Enums\EnumString;
use ReflectionClass;
use function class_exists;
use function is_a;
use function strtolower;


final class RegistrableEnumStringType extends EnumStringType
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private string $enumFqcn;
    
    
    
    //========================================================================================================
    // Abstract Methods
    //========================================================================================================
    
    final public function getEnumClassName() : string
    {
        return $this->enumFqcn;
    }
    
    
    final public static function registerEnumClass(string $classFqcn) : void
    {
        if (! class_exists($classFqcn)) {
            throw new LogicException("The enum class doesn't exists ($classFqcn)");
        }
        
        $enumTypeName = 'enum_'.strtolower((new ReflectionClass($classFqcn))->getShortName());
        if (Type::hasType($enumTypeName)) {
            return;
        }
        
        if (! is_a($classFqcn, EnumString::class, true)) {
            throw new LogicException("The enum class ($classFqcn) must extends EnumString");
        }
        
        Type::addType($enumTypeName, self::class);
        
        $type = Type::getType($enumTypeName);
        $type->enumFqcn = $classFqcn;
    }
    
    
    
}
