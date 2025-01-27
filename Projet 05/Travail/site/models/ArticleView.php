<?php
class ArticleView extends AbstractEntity
{
    private int $articleId;
    private DateTime $viewDate;

    public function getArticleId(): int
    {
        return $this->articleId;
    }
    public function setArticleId(int $newId)
    {
        $this->articleId = $newId;
    }
    public function getViewDate(): DateTime
    {
        return $this->viewDate;
    }
    public function setViewDate(string|DateTime $viewDate, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($viewDate)) {
            $viewDate = DateTime::createFromFormat($format, $viewDate);
        }
        $this->viewDate = $viewDate;
    }

}