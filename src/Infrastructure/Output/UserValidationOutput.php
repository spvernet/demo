<?php


namespace App\Infrastructure\Output;


use App\Domain\Core\AbstractOutput;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserValidationOutput extends AbstractOutput
{

    public function execute(array $data = null)
    {
        $this->init();
        if (is_array($data) && array_key_exists('errors' , $data)) {
            return new JsonResponse($data, self::CODE_BAD_REQUEST);
        } elseif ($this->hasErrors()) {
            $error = $this->getErrors();
            return new JsonResponse($error, $error['metadata'][0]['code']);
        }
        $this->output['data'] = ["id"=>$data['id'], "name"=>$data['name'], "surname"=>$data['surname']];
        return new JsonResponse($this->output);
    }


}