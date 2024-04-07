<?php

/** 
 * SOLID: The First 5 Principles of Object Oriented Design
 * O: Open-Close Principle
 * States that software entities (classes, modules, functions, etc.) should be open for extension but closed for modification. 
 * This principle aims to make a system easier to extend and maintain by allowing new functionality to be added with minimal changes to existing code.
 */

 /**
 * Example:
 * To illustrate the Open-Closed Principle, let's expand on the user management system example, focusing on the aspect of user notifications. 
 * According to OCP, we should be able to add new types of notifications (e.g., SMS, push notifications) without modifying the existing notification code.
 */

interface NotificationInterface {
    public function send(User $user, string $message): void;
}

class User {
    private $name;
    private $email;
    private $phoneNumber;

    public function __construct(string $name, string $email, string $phoneNumber) {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }
}


abstract class Notification implements NotificationInterface {
    // A concrete method that's shared by all subclasses
    protected function logMessage(string $message): void {
        // Log the message somewhere
        echo "Logging message: $message\n";
    }

    // Correctly declare the abstract method without a body
    abstract public function send(User $user, string $message): void;
}


class EmailNotification extends Notification {
    public function send(User $user, string $message): void {
        // Send email to the user
        echo "Email to {$user->getEmail()}: $message\n";
        $this->logMessage($message);
    }
}

class SMSNotification extends Notification {
    public function send(User $user, string $message): void {
        // Send SMS to the user
        echo "SMS to {$user->getPhoneNumber()}: $message\n";
        $this->logMessage($message);
    }
}

class PushNotification extends Notification {
    public function send(User $user, string $message): void {
        // Send push notification to the user
        echo "Push notification to user {$user->getName()}: $message\n";
        $this->logMessage($message);
    }
}

// Usage
$user = new User("Jane Doe", "jane@example.com", "555-1234");
$message = "Your order has been shipped!";

$notifications = [
    new EmailNotification(),
    new SMSNotification(),
    new PushNotification(),
];

foreach ($notifications as $notification) {
    $notification->send($user, $message);
}

// If you need to add a new notification method, you simply extends Notification abstruction.
// No need to modify existing classes.
