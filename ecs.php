<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\CodingStandard\Fixer\Naming\StandardizeHereNowDocKeywordFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ECSConfig): void {
    $ECSConfig->paths([
        __DIR__ . '/src',
    ]);

    // import SetList here on purpose to avoid overridden by existing Skip Option in current config
    $ECSConfig->sets(
        [SetList::PSR_12, SetList::SYMPLIFY, SetList::COMMON, SetList::CLEAN_CODE]
    );

    // https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_line_span.rst
    $ECSConfig->ruleWithConfiguration(
        PhpdocLineSpanFixer::class,
        [
            'const' => 'single',
            'property' => 'single',
        ]
    );

    $ECSConfig->skip([
        // https://github.com/symplify/coding-standard/blob/main/docs/rules_overview.md#arrayopenerandclosernewlinefixer
        ArrayOpenerAndCloserNewlineFixer::class,
        // https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/class_notation/class_attributes_separation.rst
        // Deaktiviert, da Abstand zwischen den verschiedenen Elementen nicht konfiguriert werden kann.
        // (Beispiel: Leerzeile zwischen Konstanten-Block und Property-Block nicht möglich, wenn const und property auf none steht
        ClassAttributesSeparationFixer::class,
        // https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/class_notation/ordered_class_elements.rst
        // Sollte in bestehenden Projekten deaktiviert sein, damit die Annotations mit Git Blame weiterhin verwendet werden können.
        // In neuen Projekten kann die Regel aktiviert werden.
        OrderedClassElementsFixer::class,
    ]);

    $ECSConfig->parameters()->set(Option::PARALLEL, true);
    $ECSConfig->parameters()->set(Option::LINE_ENDING, "\n");

    $services = $ECSConfig->services();

    $services->remove(PhpUnitStrictFixer::class);
    $services->remove(DeclareStrictTypesFixer::class);
    $services->remove(StandardizeHereNowDocKeywordFixer::class);
    $services->remove(Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer::class);
};
