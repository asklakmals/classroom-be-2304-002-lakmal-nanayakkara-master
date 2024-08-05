<?php

namespace OnlineStoreProject\App;

class View extends \stdClass
{
    const VIEWS_TEMPLATES_HEAD_PHP = "/../Views/templates/head.php";
    const VIEWS_TEMPLATES_NAVIGATION_PHP = "/../Views/templates/navigation.php";
    const VIEWS_TEMPLATES_FOOTER_PHP = "/../Views/templates/footer.php";
    const VIEWS_TEMPLATES_BANNER_PHP = "/../Views/templates/banner.php";
    const VIEWS_TEMPLATES_BANNER_SMALL_PHP = "/../Views/templates/bannerSmall.php";
    const VIEWS_TEMPLATES_CONTAINER_PHP = "/../Views/templates/container.php";
    const PROPERTY_NOT_FOUND_ALERT = "{{PROPERTY NOT FOUND!!!}}";
    private string $actionNameForViews;
    private string $classNameForViews;

    public static string $errorMessage = "";

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        } else {
            return self::PROPERTY_NOT_FOUND_ALERT;
        }
    }
    public function render(string $pathToView, array $dataToRender): string
    {
        $this->storeDateToRender($dataToRender);
        $fileNameWithFullPath = __DIR__ . "/../Views/" . $this->classNameForViews . "/" . $pathToView . ".php";
        if (file_exists($fileNameWithFullPath)) {
            $header = $this->getHeaderHtml();
            $content = $this->getContentHtml($fileNameWithFullPath);
            $header = $this->replacePLaceHolderWithContent($content, $header);
            $footer = $this->getFooterHtml();
            return $header . $footer;
        }
        return "";
    }

    private function storeDateToRender(array $datToRender): void
    {
        foreach ($datToRender as $key => $data) {
            $this->{$key} = $data;
        }
    }

    public function getClassNameForViews(): string
    {
        return $this->classNameForViews;
    }

    public function setClassNameForViews(string $classNameForViews): void
    {
        $this->classNameForViews = $classNameForViews;
    }

    public function getActionNameForViews(): string
    {
        return $this->actionNameForViews;
    }

    public function setActionNameForViews(string $actionNameForViews): void
    {
        $this->actionNameForViews = $actionNameForViews;
    }

    private function getHeaderHtml(): string|false
    {
        $data = $this;
        ob_start();
        include_once __DIR__ . self::VIEWS_TEMPLATES_HEAD_PHP;
        include_once __DIR__ . self::VIEWS_TEMPLATES_NAVIGATION_PHP;
        if ($this->showBanner === true) {
            include_once __DIR__ . self::VIEWS_TEMPLATES_BANNER_PHP;
        } else {
            include_once __DIR__ . self::VIEWS_TEMPLATES_BANNER_SMALL_PHP;
        }
        include_once __DIR__ . self::VIEWS_TEMPLATES_CONTAINER_PHP;
        $header = ob_get_contents();
        ob_end_clean();
        return $header;
    }

    private function getContentHtml(string $fileNameWithFullPath): string|false
    {
        $data = $this;
        ob_start();
        include_once $fileNameWithFullPath;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    private function getFooterHtml(): string|false
    {
        $data = $this;
        ob_start();
        include_once __DIR__ . self::VIEWS_TEMPLATES_FOOTER_PHP;
        $footer = ob_get_contents();
        ob_end_clean();
        return $footer;
    }

    private function replacePLaceHolderWithContent(false|string $content, false|string $header): string|array|false
    {
        $header = str_replace(CONTENT_PLACE_HOLDER, $content, $header);
        return $header;
    }
}