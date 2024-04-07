<?php

/**
 * SOLID: The First 5 Principles of Object Oriented Design
 * L: Liskov Substitution Principle LSP
 * States that objects of a superclass should be replaceable with objects of a subclass without affecting the correctness of the program. 
 * In essence, it focuses on ensuring that subclasses extend superclasses in such a way that they don't break functionality when used in place of their superclasses.
 * Implementation can be by Interfaces and abstract classes can be used to implement subtyping, 
 * ensuring that concrete classes adhering to these interfaces or extending these abstract classes can be used interchangeably.
*/

/**
 * Example:
 * This example will ensure that both engine types can be used interchangeably in a Car without altering the correctness of the program.
 */
interface EngineInterface {
    /**
     * Starts the engine. Returns true if the engine starts successfully.
     */
    public function start(): bool;

    /**
     * Checks if the engine is started.
     */
    public function isStarted(): bool;
}

class GasolineEngine implements EngineInterface {
    private $started = false;

    public function start(): bool {
        // Simulate engine start-up conditions and logic specific to gasoline engines.
        $this->started = true; // Assume engine starts successfully
        return $this->started;
    }

    public function isStarted(): bool {
        return $this->started;
    }
}

class ElectricEngine implements EngineInterface {
    private $started = false;

    public function start(): bool {
        // Simulate engine start-up conditions and logic specific to electric engines.
        $this->started = true; // Assume engine starts successfully
        return $this->started;
    }

    public function isStarted(): bool {
        return $this->started;
    }
}

class Car {
    private $engine;

    /**
     * Description: Dependency Injection is a design pattern used to implement inversion of control for resolving dependencies between objects. 
     * The main idea behind DI is to decouple objects from their dependencies, making the system easier to test, maintain, and extend. 
     * DI allows the runtime construction of dependencies, typically through constructor injection, setter injection, or interface injection.
     */
    public function __construct(EngineInterface $engine) {
        $this->engine = $engine;
    }

    public function startCar() {
        if ($this->engine->start()) {
            echo "Engine started successfully.\n";
        } else {
            echo "Engine failed to start.\n";
        }
    }

    public function checkEngineStarted() {
        if ($this->engine->isStarted()) {
            echo "The engine is running.\n";
        } else {
            echo "The engine is not running.\n";
        }
    }
}

// Test with GasolineEngine
$gasolineCar = new Car(new GasolineEngine());
$gasolineCar->startCar(); // Output: Engine started successfully.
$gasolineCar->checkEngineStarted(); // Output: The engine is running.

echo "\n"; // Newline for clarity

// Test with ElectricEngine
$electricCar = new Car(new ElectricEngine());
$electricCar->startCar(); // Output: Engine started successfully.
$electricCar->checkEngineStarted(); // Output: The engine is running.


/**
 * How This Adheres to LSP
 * Fulfilling the Contract: Both GasolineEngine and ElectricEngine implement the EngineInterface completely, 
 *                        Providing actual logic for start() and isStarted() methods.
 * Preserving Invariants: The invariant here is that an engine either is started or is not. 
 *                        This invariant is preserved across both GasolineEngine and ElectricEngine through the isStarted method, which accurately reflects the state of the engine.
 * Ensuring Postconditions: The postcondition for the start method in the EngineInterface is that if it returns true, the engine must have started successfully. 
 *                        This condition is guaranteed by both engine implementations.
 * Maintaining Preconditions: There are no additional preconditions imposed by the subclasses (GasolineEngine and ElectricEngine) on the start method beyond what is defined in the EngineInterface. 
 *                        This ensures that the method's preconditions are maintained.
 * This code demonstrates how adherence to LSP allows for the Car class to interact with an EngineInterface without needing to know the specific type of engine, 
 *                        Promoting a design that is more flexible and maintainable.
*/
