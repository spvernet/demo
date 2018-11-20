<?php


namespace App\Infrastructure\Output;


use Symfony\Component\HttpFoundation\JsonResponse;

class UserValidationOutput
{

    public function __construct()
    {

    }

    public function execute(array $data = array())
    {
/*        if ($this->hasErrors()) {
            return $this->getErrorResponse();
        }

        if ($this->getTotalCount($data) <= 0) {

        }*/

        try {
            //Build document
        } catch (\Exception $e) {
            return new JsonResponse(/* ERROR*/);
        }

        $outputResponse = new JsonResponse(/* OK*/ );

        return $outputResponse;
    }


}