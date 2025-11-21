<?php


class DiscussionController
{
    /**
     * Affiche la page de discussion.
     * @return void
     */
    public function showDiscussion(): void
    {

        $id = Utils::request('id');
        $title = "Discussion";
        $user = null;
        if (!empty($id)) {
            $userManager = new UserManager();
            $user = $userManager->getUserById($id);
            if ($user) {
                $title = "Discussion avec " . $user->getPseudo();
            }
        } 
        
        // $discussionManager = new DiscussionManager();
        // $discussions = $discussionManager->getDiscussionsByUser($id);
        
        

        $view = new View($title);
        $view->render("discussion", ['user' => $user]);
    }
}