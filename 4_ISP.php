<?php

/** 
 * SOLID: The First 5 Principles of Object Oriented Design
 * I: Interface-Segregation Principle (ISP)
 * States that no client should be forced to depend on methods it does not use. 
 * Essentially, it encourages splitting large interfaces into smaller, more specific ones so that implementing classes only need to be concerned with the methods that are relevant to them.
 */


interface Printable {
    public function printDocument(string $document);
}

interface Scannable {
    public function scanDocument(string $document);
}

interface Faxable {
    public function faxDocument(string $document);
}

// A class that implements all functionalities from different interfaces
class MultiFunctionPrinter implements Printable, Scannable, Faxable {
    public function printDocument(string $document) {
        echo "Printing document: $document\n";
    }

    public function scanDocument(string $document) {
        echo "Scanning document: $document\n";
    }

    public function faxDocument(string $document) {
        echo "Faxing document: $document\n";
    }
}

// A class that only needs to implement printing
class SimplePrinter implements Printable {
    public function printDocument(string $document) {
        echo "Printing document: $document\n";
    }
}

// Usage
$multiFunctionPrinter = new MultiFunctionPrinter();
$multiFunctionPrinter->printDocument("MultiFunction: Report.pdf");
$multiFunctionPrinter->scanDocument("MultiFunction: Receipt.pdf");
$multiFunctionPrinter->faxDocument("MultiFunction: Invoice.pdf");

$simplePrinter = new SimplePrinter();
$simplePrinter->printDocument("Simple: Letter.txt");

/**
 * Explanation
 * Printable, Scannable, Faxable: These interfaces represent the segregation of printer functionalities. Each interface has a single responsibility, 
 *      aligning with the Single Responsibility Principle (SRP) and the Interface Segregation Principle (ISP).
 * MultiFunctionPrinter: This class implements all three interfaces because it is capable of performing all the actions (print, scan, fax).
 * SimplePrinter: This class only implements the Printable interface because it only needs to print documents. 
 *      It's not forced to implement scanDocument or faxDocument methods, adhering to 
 * .
 * Example above demonstrates the Interface Segregation Principle by ensuring that classes only implement the interfaces they use, 
 *      thus avoiding the necessity of implementing irrelevant methods. This design promotes cleaner, more maintainable, and more understandable code.
 */