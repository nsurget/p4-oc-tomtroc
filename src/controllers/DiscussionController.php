<?php


class DiscussionController
{
    /**
     * Affiche la page de discussion.
     * @return void
     */
    public function showDiscussion(): void
    {
        Utils::checkUserConnected();

        $requestId = Utils::request('id');

        $discussionManager = new DiscussionManager();
        $discussions = $discussionManager->getDiscussionsByUser($_SESSION['idUser']);



        $active_discussion_id = null;
        $userManager = new UserManager();
        if (!empty($requestId)) {
            
            $requestUser = $userManager->getUserById($requestId);

            if ($requestUser === null) {
                throw new Exception("Utilisateur non trouvé");
            }

            foreach ($discussions as $discussion) {
                if ($discussion->getUser1Id() == $requestId || $discussion->getUser2Id() == $requestId) {
                    $active_discussion_id = $discussion->getId();
                    break;
                }
            }

            if ($active_discussion_id === null) {    
                $tempDiscussion = new Discussion();
                $tempDiscussion->setUser1Id($requestId);
                $tempDiscussion->setUser2Id($_SESSION['idUser']);
                $tempDiscussion->setNewMessagesCount(0);
                $tempDiscussion->setRequestUserPicture($requestUser->getProfilPicture());
                $tempDiscussion->setRequestUserPseudo($requestUser->getPseudo());
                $tempDiscussion->setLastMessageContent('');
                $tempDiscussion->setLastMessageAt(null);
                $tempDiscussion->setLastMessageUserId(null);
                $discussions[] = $tempDiscussion;
            }

        } elseif (!empty($discussions)) {
            $active_discussion_id = $discussions[0]->getId();
            $requestUser = $userManager->getUserById($discussions[0]->getUser1Id() == $_SESSION['idUser'] ? $discussions[0]->getUser2Id() : $discussions[0]->getUser1Id());
        }

        $messages = [];
        if (!empty($active_discussion_id)) {
            $messageManager = new MessageManager();
            $messages = $messageManager->getMessagesByDiscussion($active_discussion_id);
        }
        
        if (!empty($requestUser)) {
            $title = "Discussion avec " . $requestUser->getPseudo();
        } else {
            $title = "Discussion";
        }
        
        $view = new View($title);
        $view->render("discussion", ['request_user' => $requestUser ?? null, 'discussions' => $discussions, 'active_discussion_id' => $active_discussion_id, 'messages' => $messages]);
    }

    public function sendMessage(): void
    {
        Utils::checkUserConnected();

        $requestUserId = Utils::request('id');
        $messageContent = Utils::request('content');

        $discussionManager = new DiscussionManager();
        $discussion = $discussionManager->getDiscussionById($requestUserId, $_SESSION['idUser']);
        if ($discussion) {
            $messageManager = new MessageManager();
            $messageManager->addMessage($discussion->getId(), $_SESSION['idUser'], $messageContent);
            $discussionManager->addOneNewMessagesCount($discussion->getId());
        } else {
            $discussion = $discussionManager->addDiscussion($requestUserId, $_SESSION['idUser']);
            $messageManager = new MessageManager();
            $messageManager->addMessage($discussion->getId(), $_SESSION['idUser'], $messageContent);
            $discussionManager->addOneNewMessagesCount($discussion->getId());
        }

        header('Location: ?action=' . AppRoutes::SHOW_DISCUSSION . '&id=' . $requestUserId);
        exit;
    }
}