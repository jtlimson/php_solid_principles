<?php

/** 
 * SOLID: The First 5 Principles of Object Oriented Design
 * D: Dependency Inversion Principle (DIP)
 * States two key things
 * 1. High-level modules should not depend on low-level modules. Both should depend on abstractions.
 * 2. Abstractions should not depend upon details. Details should depend upon abstractions.
 * 
 * In simpler terms, DIP advises us to couple our code to the interface or an abstract class rather than concrete classes.
 *  This approach makes our code more flexible and enables easier maintenance and testing
 */

/**
 * Example:
 * To illustrate DIP with a modification of the printer scenario, focusing on how a high-level module (e.g., a document processing system) 
 * can depend on abstractions (e.g., a printing interface) 
 * rather than concrete implementations of a printer.
 */

// Abstractions (interfaces)
interface PrinterInterface {
    public function printContent(string $content);
}

interface ScannerInterface {
    public function scanContent() : string;
}

// High-level module
class DocumentProcessor {
    private $printer;
    private $scanner;

    // The DocumentProcessor depends on the abstractions rather than concrete implementations.
    public function __construct(PrinterInterface $printer, ScannerInterface $scanner) {
        $this->printer = $printer;
        $this->scanner = $scanner;
    }

    public function copyDocument() {
        $scannedContent = $this->scanner->scanContent();
        $this->printer->printContent($scannedContent);
    }
}

// Low-level module implementations
class BasicPrinter implements PrinterInterface {
    public function printContent(string $content) {
        echo "Basic Printer: Printing content - $content\n";
    }
}

class AdvancedScanner implements ScannerInterface {
    public function scanContent(): string {
        // Simulate scanning content
        return "Scanned content from Advanced Scanner";
    }
}

// Usage
$basicPrinter = new BasicPrinter(); //concrete class
$advancedScanner = new AdvancedScanner(); //concrete class

// The high-level module (DocumentProcessor) is not directly dependent on the low-level modules (BasicPrinter, AdvancedScanner).
// It is only dependent on their abstractions (interfaces).
$documentProcessor = new DocumentProcessor($basicPrinter, $advancedScanner);
$documentProcessor->copyDocument();


/**
 * Key Points:
 * Abstraction Over Implementation: The DocumentProcessor class doesn't need to know about the specifics of the printer or scanner. 
 *      It only knows that it can print and scan through the interfaces Printer and Scanner. 
 *      This makes DocumentProcessor more flexible and not tied to specific implementations of printing or scanning, allowing for easy substitution or extension.
 * Decoupled Code: This structure makes the code more modular and decoupled, as changes in the details of printing or scanning implementation do not affect the high-level policy (DocumentProcessor). 
 *      For example, if a new type of HighEndPrinter is introduced, it can easily be integrated into the system as long as it implements the Printer interface.
 * Ease of Testing: Dependency Inversion facilitates unit testing by allowing mocks or stubs to replace the concrete implementations of Printer and Scanner during testing of the DocumentProcessor functionality.
 */


//sample to mock DocumentProcessorTest
//NOTE: composer require --dev phpunit/phpunit

use PHPUnit\Framework\TestCase;

class DocumentProcessorTest extends TestCase {
    public function testCopyDocument() {
        // Create a mock for the Printer interface
        $printerMock = $this->createMock(BasicPrinter::class);
        // Expect the printContent method to be called once with the string "Scanned content from mock"
        $printerMock->expects($this->once())
                    ->method('printContent')
                    ->with($this->equalTo("Scanned content from mock"));

        // Create a mock for the Scanner interface
        $scannerMock = $this->createMock(AdvancedScanner::class);
        // Configure the mock to return "Scanned content from mock" when the scanContent method is called
        $scannerMock->method('scanContent')
                    ->willReturn('Scanned content from mock');

        // Create an instance of DocumentProcessor with the mock objects
        $documentProcessor = new DocumentProcessor($printerMock, $scannerMock);

        // Execute the copyDocument method, which should use the mock objects
        $documentProcessor->copyDocument();

        // Assertions are handled by the expectations set on the mock objects
        // PHPUnit will automatically fail the test if those expectations are not met
    }
}
