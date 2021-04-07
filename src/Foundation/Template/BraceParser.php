<?php

namespace Maestriam\FileSystem\Foundation\Template;

abstract class BraceParser
{
    /**
     * Substitui as lacunas de um template pelo seu real conteúdo
     *
     * @param string $content
     * @param array $placeholders
     * @return string
     */
    static public function parse(string $content, array $placeholders = []) : string
    {
        foreach ($placeholders as $placeholder => $word) {

            if (is_array($placeholder) || is_array($word)) {
                throw new \Exception();                
            }

            $search  = sprintf('{{%s}}', $placeholder);
            $content = str_replace($search, $word, $content);                        
        }

        return $content;
    }
}