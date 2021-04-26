<?php declare(strict_types=1);

namespace Mediagone\Doctrine\Types\Enums;

use LogicException;
use Mediagone\Types\Enums\EnumInt;
use Mediagone\Types\Enums\EnumString;
use function array_map;
use function class_exists;
use function is_a;


final class DoctrineEnumTypesLoader
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private array $enumClasses;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(array $enumClasses = [])
    {
        $this->enumClasses = $enumClasses;
    }
    
    
    
    //========================================================================================================
    // EventSubscriberInterface interface
    //========================================================================================================
    
    public function registerEnumTypes(?array $enumClasses = null) : void
    {
        $enumClasses = array_map(static fn(string $c) => $c, $enumClasses ?? $this->enumClasses); 
        
        foreach ($enumClasses as $fqcn) {
            if (! class_exists($fqcn)) {
                throw new LogicException("The enum class doesn't exists ($fqcn)");
            }
            
            if (is_a($fqcn, EnumInt::class, true)) {
                RegistrableEnumIntType::registerEnumClass($fqcn);
            }
            elseif (is_a($fqcn, EnumString::class, true)) {
                RegistrableEnumStringType::registerEnumClass($fqcn);
            }
            else {
                throw new LogicException("Unsupported enum class ($fqcn), it must extends EnumInt or EnumString.");
            }
        }
    }
    
    
    
}
