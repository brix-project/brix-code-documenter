<?php

namespace Brix\CodeDocumenter;

use Brix\Core\AbstractBrixCommand;

class Code_Doc extends AbstractBrixCommand
{

    public \T_CodeDocConfig $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = $this->brixEnv->brixConfig->get(
            "code_doc",
            \T_CodeDocConfig::class,
            file_get_contents(__DIR__ . "/config_tpl.yml")
        );
    }

    public function generate()
    {

        $files = glob($this->config->examples_dir);

        $input = "";
        foreach ($files as $file) {
            $input .= "\n\nFrom: $file\n\"\"\"\n" . file_get_contents($file) . "\n\"\"\"\n\n";
        }

        $this->brixEnv->getOpenAiQuickFacet()->promptStreamToFile(__DIR__ . "/prompt.txt", ["input" => $input], $this->config->output_file);

    }

}
