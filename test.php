<?php

function reverseWords(string $text): string
{
    // Защита от null
    if ($text === null) {
        return '';
    }
    // Регулярное выражение для поиска слов (только буквы Unicode)
    // Всё остальное; запятые, пробелы, дефисы, числа  не трогаем
    return preg_replace_callback(
        '/\p{L}+/u',
        function ($matches) {
            $word = $matches[0];

            // Получаем буквы и их тип регистра
            $letters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
            $isUpper = array_map(fn($ch) => mb_strtoupper($ch, 'UTF-8') === $ch, $letters);


            // Разворачиваем буквы
            $reversed = array_reverse($letters);

            // Применяем регистр исходного слова (позиционно)
            foreach ($reversed as $i => &$ch) {
                $ch = $isUpper[$i]
                    ? mb_strtoupper($ch, 'UTF-8')
                    : mb_strtolower($ch, 'UTF-8');
            }

            // объединяем массив в строку
            return implode('', $reversed);
        },
        $text
    );
}