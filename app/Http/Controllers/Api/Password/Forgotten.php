<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Password;

use App\Http\Requests\Api\Password\ForgottenRequest;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Translation\Translator;

final class Forgotten
{
    /**
     * @var \Illuminate\Auth\Passwords\PasswordBrokerManager
     */
    protected $passwordBrokerManager;

    /**
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $responseFactory;

    /**
     * @var \Illuminate\Contracts\Translation\Translator
     */
    protected $translator;

    /**
     * Reset constructor.
     *
     * @param  \Illuminate\Auth\Passwords\PasswordBrokerManager $passwordBrokerManager
     * @param  \Illuminate\Contracts\Routing\ResponseFactory    $responseFactory
     * @param  \Illuminate\Contracts\Translation\Translator     $translator
     */
    public function __construct(
        PasswordBrokerManager $passwordBrokerManager,
        ResponseFactory $responseFactory,
        Translator $translator
    ) {
        $this->passwordBrokerManager = $passwordBrokerManager;
        $this->responseFactory = $responseFactory;
        $this->translator = $translator;
    }

    /**
     * @param  \App\Http\Requests\Api\Password\ForgottenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ForgottenRequest $request)
    {
        $this->getPasswordBroker()->sendResetLink($request->validated());

        return $this->responseFactory->json([
            'message' => $this->translator->trans(PasswordBroker::RESET_LINK_SENT),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function getPasswordBroker(): PasswordBroker
    {
        return $this->passwordBrokerManager->broker('users');
    }
}
