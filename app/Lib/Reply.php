<?php

namespace lsa\Lib;

/**
 * Generates a reply from the API to the client.
 *
 * All replies to the app should go through this!
 */

class Reply
{
    /**
     * @var Object  Payload of data.
     */
    public $data = [];

    /**
     * @var Object
     */
    public $errors = [];

    /**
     * @var string Response time
     */
    public $responseTime;

    /**
     * @return string
     */
    public function __toString()
    {
        $this->responseTime = microtime(true) - BOOTSTRAP_START_TIME;

        if (empty($this->errors)) {
            unset($this->errors);
        } else {
            unset($this->data);
        }

        $json = json_encode($this);

        return $json;
    }

    /**
     * Use when set Response Data
     *
     * @param   mixed
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Use when set Runtime or Validation errors
     *
     * @param array  $errors
     * @param string $type
     */
    public function setErrors($errors, $type = 'validation')
    {
        $this->errors[$type] = $errors;
    }

    /**
     * Use when set Api errors
     *
     * @param string $code
     * @param string $message
     */
    public function setApiError($code = '000', $message = null)
    {
        $this->errors['api'] = [
            "code"    => $code,
            "message" => is_null($message) ? \Config::get('codes.' . $code) : $message,
        ];
    }
}
