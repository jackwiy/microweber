<?php

namespace Tests\Browser\Multilanguage;

use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\AdminContentMultilanguage;
use Tests\Browser\Components\AdminLogin;
use Tests\Browser\Components\ChekForJavascriptErrors;
use Tests\Browser\Components\FrontendSwitchLanguage;
use Tests\Browser\Components\LiveEditModuleAdd;
use Tests\Browser\Components\LiveEditSwitchLanguage;
use Tests\DuskTestCase;
use Tests\DuskTestCaseMultilanguage;

class LiveEditMultilanguageTest extends DuskTestCaseMultilanguage
{

    public function testLiveEditNewPageSave()
    {
        $siteUrl = $this->siteUrl;

        $this->browse(function (Browser $browser) use ($siteUrl) {

            $browser->within(new AdminLogin, function ($browser) {
                $browser->fillForm();
            });

            $browser->within(new AdminContentMultilanguage(), function ($browser) {
                $browser->addLanguage('bg_BG');
                $browser->addLanguage('en_US');
            });
            $currentLocale = mw()->lang_helper->current_lang();

            run_translate_manager();
            // reload page
            $browser->script('window.location.reload();');

            $browser->within(new ChekForJavascriptErrors(), function ($browser) {
                $browser->validate();
            });

            $params = array(
                'title' => 'My new page ML ' . time(),
                'content_type' => 'page',
                'content' => '<h1 id="h1-test-element">My new page ML</h1>',
                'subtype' => 'static',
                'is_active' => 1,);


            $saved_id = save_content($params);

            $siteUrl = content_link($saved_id);


            $browser->visit($siteUrl . '?editmode=y');
            $browser->pause(4000);

            $browser->waitFor('#live-editor-frame', 30)
                ->withinFrame('#live-editor-frame', function ($browser) {
                    $browser->within(new ChekForJavascriptErrors(), function ($browser) {
                        $browser->validate();
                    });
                    $browser->pause(1000);
                });

            $iframeElement = $browser->driver->findElement(WebDriverBy::id('live-editor-frame'));
            $browser->switchFrame($iframeElement);

            $browser->pause(1000);
            $browser->click('#h1-test-element'  );
            $browser->doubleClick('#h1-test-element'  );
            $browser->pause(1000);
            $browser->typeSlowly('#h1-test-element' , 'This is my text on english language');

            $browser->switchFrameDefault();
            $browser->click('#save-button');

            // Switch to Bulgarian
            $browser->pause(3000);

            $iframeElement = $browser->driver->findElement(WebDriverBy::id('live-editor-frame'));
            $browser->switchFrame($iframeElement);



            $browser->within(new FrontendSwitchLanguage(), function ($browser) {
                $browser->switchLanguage('bg_BG');
            });

            $browser->pause(3000);


            $browser->pause(1000);
            $browser->click('#h1-test-element'  );
            $browser->doubleClick('#h1-test-element'  );
            $browser->pause(1000);


            $browser->typeSlowly('#h1-test-element', 'Текст написан на български, това е българска страница');

            $browser->switchFrameDefault();
            $browser->click('#save-button');
            $browser->pause(3000);


            $iframeElement = $browser->driver->findElement(WebDriverBy::id('live-editor-frame'));
            $browser->switchFrame($iframeElement);
            // Switch to English

            $browser->within(new FrontendSwitchLanguage(), function ($browser) {
                $browser->switchLanguage('en_US');
            });
            $browser->pause(1000);
            $browser->assertSee('This is my text on english language');

            // Switch back to Bulgarian
            $browser->pause(1000);
            $browser->within(new FrontendSwitchLanguage(), function ($browser) {
                $browser->switchLanguage('bg_BG');
            });
            $browser->pause(1000);
            $browser->assertSee('Текст написан на български, това е българска страница');



        });

    }

}
