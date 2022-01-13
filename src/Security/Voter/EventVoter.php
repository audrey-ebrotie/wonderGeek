<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\Event;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class EventVoter extends Voter
{
    const EVENT_EDIT = 'event_edit';
    const EVENT_DELETE = 'event_delete';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    protected function supports(string $attribute, $event): bool
    {
        return in_array($attribute, [self::EVENT_EDIT, self::EVENT_DELETE]) // On vérifie qu'il s'agit bien d'une instance de l'entity Event
            && $event instanceof \App\Entity\Event;
    }

    protected function voteOnAttribute(string $attribute, $event, TokenInterface $token): bool
    {
        $user = $token->getUser();
        
        if (!$user instanceof UserInterface){   // Si le user n'est pas connecté, on return false, sinon -> switch
            return false;
        }

        if($this->security->isGranted('ROLE_MODERATOR')) return true;   // on vérifie que l'utilisateur est modérateur ou admin

        if(null === $event->getOwner()) return false;   // on vérifie si levent a un owner

        switch ($attribute) {
            case self::EVENT_EDIT:
                return $this->allowedToEdit($event, $user);     // on vérifie si le user est autorisé à éditer l'event
                break; 
            case self::EVENT_DELETE:
                return $this->allowedToDelete($event, $user);    // on vérifie si le user est autorisé à supprimer l'event
                break;
        }

        return false;
    }

    private function allowedToEdit(Event $event, User $user){
        return $user === $event->getOwner();    // le propriétaire de l'event peut le modifier
    }

    private function allowedToDelete(Event $event, User $user){
        return $user === $event->getOwner();    // le propriétaire de l'event peut le supprimer
    }
}
