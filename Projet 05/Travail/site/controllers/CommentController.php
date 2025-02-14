<?php

class CommentController 
{
    /**
     * Ajoute un commentaire.
     * @return void
     */
    public function addComment() : void
    {
        // Récupération des données du formulaire.
        $pseudo = Utils::request("pseudo");
        $content = Utils::request("content");
        $idArticle = Utils::request("idArticle");

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($content) || empty($idArticle)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        // On vérifie que l'article existe.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($idArticle);
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        // On crée l'objet Comment.
        $comment = new Comment([
            'pseudo' => $pseudo,
            'content' => $content,
            'idArticle' => $idArticle
        ]);

        // On ajoute le commentaire.
        $commentManager = new CommentManager();
        $result = $commentManager->addComment($comment);

        // On vérifie que l'ajout a bien fonctionné.
        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout du commentaire.");
        }

        // On redirige vers la page de l'article.
        Utils::redirect("showArticle", ['id' => $idArticle]);
    }

    public function deleteComment() : void
    {
        // On vérifie qu'on est admin
        AdminController::checkIfUserIsAdmin();

        // On vérifie l'id en entrée
        $commentId = filter_var(Utils::request('id', -1), FILTER_VALIDATE_INT);
        if (!$commentId) {
            throw new Exception("Erreur en entrée.");
        }
        $commentManager = new CommentManager();
        $comment = $commentManager->getCommentById($commentId);
        if (!$comment) {
            throw new Exception("Aucun commentaire ne correspond à cet identifiant.");
        }

        // Récupération de l'article pour la redirection
        $originalArticle = $comment->getIdArticle();

        // Suppression de l'article
        try {
            $commentManager->deleteComment($comment);
        } catch (Exception $e) {
            throw new Exception("Erreur pendant la suppression du commentaire : $commentId");
        }

        // Redirection
        Utils::redirect("showArticle", ['id' => $originalArticle]);
    }
}