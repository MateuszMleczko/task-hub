<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\I18n\I18n;

/**
 * Legal Controller
 *
 * Public legal documents. Each document has one template per locale in
 * `templates/Legal/<locale>/`, because legal text reads better as a whole
 * than split into translation strings.
 */
class LegalController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['privacy']);
    }

    /**
     * Privacy policy (GDPR art. 13 information clause).
     *
     * @return void
     */
    public function privacy(): void
    {
        $administrator = Configure::read('PrivacyPolicy.administrator');
        $address = Configure::read('PrivacyPolicy.address');
        $contactEmail = Configure::read('PrivacyPolicy.contactEmail');

        $this->set(compact('administrator', 'address', 'contactEmail'));

        $this->viewBuilder()->setTemplatePath('Legal/' . I18n::getLocale());
    }
}
