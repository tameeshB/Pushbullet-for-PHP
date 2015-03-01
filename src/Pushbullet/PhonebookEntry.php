<?php

namespace Pushbullet;

class PhonebookEntry
{
    private $deviceParent;

    private $phone;

    public function __construct($properties, Device $parent)
    {
        foreach ($properties as $k => $v) {
            $this->$k = $v ?: null;
        }

        $this->deviceParent = $parent;
    }

    /**
     * Send an SMS message to the contact.
     *
     * @param string $message Message.
     *
     * @return Push
     * @throws Exceptions\InvalidRecipientException
     * @throws Exceptions\NoSmsException
     */
    public function sendSms($message)
    {
        if (empty($this->phone)) {
            throw new Exceptions\InvalidRecipientException("Phonebook entry doesn't have a phone number.");
        }

        return $this->deviceParent->sendSms($this->phone, $message);
    }
}
