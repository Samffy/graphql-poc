<?php

namespace App\Common\Infra\Validator;

use App\Common\App\Transformer\AppGlobalId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IdExistConstraintValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @throws \ReflectionException
     */
    public function validate($identifier, Constraint $constraint)
    {
        if ($identifier === null || !is_string($identifier)) {
            return;
        }

        if (!class_exists($constraint->getFqcn())) {
            throw new \InvalidArgumentException(sprintf(
                'Constraint FQCN [%s] does not exist',
                $constraint->getFqcn()
            ));
        }

        if ($this->getRepository($constraint->getFqcn())->find($identifier) === null) {
            $this->context->buildViolation($constraint->getMessage())
                ->setParameters([
                    '%className%' => (new \ReflectionClass($constraint->getFqcn()))->getShortName(),
                    '%id%' => AppGlobalId::toGlobalId((new \ReflectionClass($constraint->getFqcn()))->getShortName(), $identifier),
                ])
                ->addViolation();
        }
    }

    protected function getRepository(string $fqcn): EntityRepository
    {
        return $this->em->getRepository($fqcn);
    }
}
