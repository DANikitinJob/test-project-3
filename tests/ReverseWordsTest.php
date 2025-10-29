<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../test.php';

final class ReverseWordsTest extends TestCase
{
    public function testSimpleLatinWord(): void
    {
        $this->assertSame('Tac', reverseWords('Cat'));
    }

    public function testSimpleCyrillicWord(): void
    {
        $this->assertSame('Ьшым', reverseWords('Мышь'));
    }

    public function testMixedCaseLatin(): void
    {
        $this->assertSame('esuOh', reverseWords('houSe'));
    }

    public function testWordWithPunctuation(): void
    {
        $this->assertSame('tac,', reverseWords('cat,'));
        $this->assertSame('Амиз:', reverseWords('Зима:'));
    }

    public function testPhraseWithQuotesAndApostrophes(): void
    {
        $this->assertSame("si 'dloc' won", reverseWords("is 'cold' now"));
        $this->assertSame('отэ «Кат» "отсорп"', reverseWords('это «Так» "просто"'));
    }

    public function testHyphenAndBacktick(): void
    {
        $this->assertSame('driht-trap', reverseWords('third-part'));
        $this->assertSame('nac`t', reverseWords("can`t"));
    }

    public function testEmptyString(): void
    {
        $this->assertSame('', reverseWords(''));
    }

    public function testShortWords(): void
    {
        // Однобуквенные слова не меняются
        $this->assertSame('A', reverseWords('A'));
        $this->assertSame('a', reverseWords('a'));
        $this->assertSame('Я', reverseWords('Я'));
    }
}
