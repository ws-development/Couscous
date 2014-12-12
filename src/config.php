<?php

use Interop\Container\ContainerInterface;

return array(

    'steps.classes' => array(
        'Couscous\Step\ClearTargetDirectory',
        'Couscous\Step\Config\SetDefaultConfig',
        'Couscous\Step\Config\LoadConfig',
        'Couscous\Step\Config\OverrideBaseUrlForPreview',
        'Couscous\Module\Scripts\Step\ExecuteBeforeScripts',
        'Couscous\Module\Template\Step\UseDefaultTemplate',
        'Couscous\Module\Template\Step\FetchRemoteTemplate',
        'Couscous\Module\Template\Step\ValidateTemplateDirectory',
        'Couscous\Module\Bower\Step\RunBowerInstall',
        'Couscous\Module\Template\Step\LoadAssets',
        'Couscous\Module\Markdown\Step\LoadMarkdownFiles',
        'Couscous\Module\Markdown\Step\ParseMarkdownFrontMatter',
        'Couscous\Module\Markdown\Step\ProcessMarkdownFileName',
        'Couscous\Module\Markdown\Step\ProcessMarkdownLinks',
        'Couscous\Module\Markdown\Step\RenderMarkdown',
        'Couscous\Module\Template\Step\AddPageListToLayoutVariables',
        'Couscous\Module\Template\Step\ProcessTwigLayouts',
        'Couscous\Step\WriteFiles',
        'Couscous\Module\Scripts\Step\ExecuteAfterScripts',
    ),
    'steps' => DI\factory(function (ContainerInterface $c) {
        return array_map(function ($class) use ($c) {
            return $c->get($class);
        }, $c->get('steps.classes'));
    }),

    'Couscous\Generator' => DI\object()
        ->constructorParameter('steps', DI\link('steps')),

    'Mni\FrontYAML\Parser' => DI\object()
        ->constructorParameter('markdownParser', DI\link('Mni\FrontYAML\Markdown\MarkdownParser')),
    'Mni\FrontYAML\Markdown\MarkdownParser' => DI\object('Mni\FrontYAML\Bridge\Parsedown\ParsedownParser')
        ->constructor(DI\link('ParsedownExtra')),

);
