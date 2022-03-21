<?php

namespace App\Security\Voter;

use App\Entity\Empleado;
use App\Entity\Venta;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class VentaVoter extends Voter
{
    /**
     * @var AccessDecisionManagerInterface
     */
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * @inheritDoc
     */
    protected function supports($attribute, $subject): bool
    {
        if (!$subject instanceof Venta) {
            return false;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        if (!$subject instanceof Venta) {
            return false;
        }

        $fecha = $subject->getFechaVenta();
        $fechaActual = New \DateTime();

        $diferenciaMinutos = $fechaActual->diff($fecha)->m;

        if ($this->decisionManager->decide($token, ["ROLE_ADMIN"])) {
            return true;
        }

        if ($diferenciaMinutos < 30) {
            return true;
        }

        return false;
    }
}
