<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class PagesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @return array<string, array{string}>
     */
    public static function publicPages(): array
    {
        return [
            'home' => ['/'],
            'login' => ['/users/login'],
            'register' => ['/users/register'],
            'privacy policy' => ['/privacy-policy'],
        ];
    }

    #[DataProvider('publicPages')]
    public function testPublicPagesLinkToTheAuthor(string $url): void
    {
        $this->get($url);

        $this->assertResponseOk();
        $this->assertResponseContains('https://www.linkedin.com/in/mateusz-mleczko-3b2b21265/');
        $this->assertResponseContains('https://github.com/MateuszMleczko');
        $this->assertResponseContains('mailto:mateusz.mleczko@techtreesolutions.net');
        $this->assertResponseContains('img/brands/linkedin-in-bug.png');
        $this->assertResponseContains('img/brands/github-invertocat-black.svg');
    }

    public function testNotFoundPageUsesTheSiteLayout(): void
    {
        Configure::write('debug', false);
        Configure::write('App.fullBaseUrl', 'http://localhost');

        $this->get('/no-such-page');

        $this->assertResponseCode(404);
        $this->assertResponseContains('error-page__title');
        $this->assertResponseContains('site-footer');
    }
}
