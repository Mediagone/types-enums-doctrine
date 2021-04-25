<?php declare(strict_types=1);

namespace Mediagone\Doctrine\Types\Enums;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use LogicException;
use Mediagone\Types\Enums\EnumInt;
use function gettype;
use function is_a;


abstract class EnumIntType extends IntegerType
{
    //========================================================================================================
    // Type implementation
    //========================================================================================================
    
    /**
     * Adds an SQL comment to typehint the actual Doctrine Type for reverse schema engineering.
     */
    final public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }
    
    
    /**
     * Converts a value from its PHP representation to its database representation of this type.
     */
    final public function convertToDatabaseValue($value, AbstractPlatform $platform) : ?int
    {
        if ($value === null) {
            return null;
        }
        
        $enumFqcn = $this->getEnumClassName();
        if (! is_a($value, $enumFqcn, true)) {
            throw new LogicException('Value to convert to database format must be an instance of "'. $enumFqcn .'", got "'. gettype($value) .'".');
        }
        
        return $value->value;
    }
    
    
    /**
     * Converts a value from its database representation to its PHP representation of this type.
     */
    final public function convertToPHPValue($value, AbstractPlatform $platform) : ?EnumInt
    {
        if ($value === null) {
            return null;
        }
        
        return $this->getEnumClassName()::from((int)$value);
    }
    
    
    
    //========================================================================================================
    // Abstract Methods
    //========================================================================================================
    
    abstract public function getEnumClassName() : string;
    
    
    
}
