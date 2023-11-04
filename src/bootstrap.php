<?php


namespace Brix;


use Brix\CodeDocumenter\Code_Doc;
use Brix\Core\BrixEnvFactorySingleton;
use Phore\Cli\CliDispatcher;

CliDispatcher::addClass(Code_Doc::class);
