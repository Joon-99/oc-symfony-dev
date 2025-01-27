<?php
class ArticleViewManager extends AbstractEntityManager
{
    public function getViewsById(int $articleId): array
    {
        $sql = <<<SQL
            SELECT *
            FROM article_view
            WHERE article_id = :id
        SQL;
        $parameters = [
            'id' => $articleId,
        ];
        $result = $this->db->query($sql, $parameters);
        $views = [];
        foreach ($result as $row) {
            $views[] = new ArticleView($row);
        }
        return $views;
    }

    public function getNbViewsById(int $articleId): int
    {
        return count($this->getViewsById($articleId));
    }
    public function createArticleView(int $articleId): bool
    {
        $sql = <<<SQL
            INSERT INTO article_view (article_id, view_date)
            VALUES (:id, NOW())
        SQL;
        $parameters = [
            'id' => $articleId,
        ];
        $result = $this->db->query($sql, $parameters);
        return $result->rowCount() > 0;
    }
}