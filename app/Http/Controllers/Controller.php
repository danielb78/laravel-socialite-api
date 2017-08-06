<?php

namespace lsa\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use lsa\Lib\Reply;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Response using Reply - success
     *
     * @param array $data
     *
     * @return Reply
     */
    protected function success($data = [])
    {
        $this->reply->setData($data);

        return  $this->reply;
    }

    /**
     * Response using Reply - api errors
     *
     * @param string $code
     * @param string $message
     *
     * @return Reply
     */
    public function error($code = '000', $message = null)
    {
        $this->reply->setApiError($code, $message);

        return $this->reply;
    }

    /**
     * Response using Reply - validation and runtime errors
     *
     * @param array $errors
     * @param string $type
     *
     * @return Reply
     */
    public function errors($errors, $type='validation')
    {
        $this->reply->setErrors($errors, $type);

        return $this->reply;
    }
}
