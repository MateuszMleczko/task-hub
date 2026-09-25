<?php
$this->assign('title', 'Privacy policy');
$this->Html->css('legalStyle', ['block' => true]);
?>

<article class="legal">
    <header class="legal__header">
        <h1 class="legal__title">Privacy policy</h1>
        <p class="legal__meta">Effective from 24 September 2026</p>
    </header>

    <p class="legal__lead">
        This document explains what personal data TaskHub processes, why, how long we keep it and what rights
        you have. It fulfils the information obligation under Article 13 of Regulation (EU) 2016/679 of the
        European Parliament and of the Council (GDPR).
    </p>

    <section class="legal__section">
        <h2 class="legal__heading">1. Data controller</h2>
        <p class="legal__text">
            The controller of your personal data is <?= h($administrator) ?>, <?= h($address) ?>
            (the “Controller”).
        </p>
        <p class="legal__text">
            For any matter concerning your personal data you can contact the Controller at
            <a class="legal__link" href="mailto:<?= h($contactEmail) ?>"><?= h($contactEmail) ?></a>.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">2. What data we process</h2>
        <ul class="legal__list">
            <li class="legal__item"><strong>Account data:</strong> name, email address, password (stored only
                as a cryptographic hash — nobody, including the Controller, knows your password), chosen avatar,
                and the dates the account was created and the privacy policy was accepted.</li>
            <li class="legal__item"><strong>Content you add:</strong> tasks with their title, description,
                status, priority and deadline.</li>
            <li class="legal__item"><strong>Password reset data:</strong> a single-use token sent to your email
                address when you use the “Forgot password” feature.</li>
            <li class="legal__item"><strong>Technical data:</strong> IP address and request details (such as
                date, page address and browser) recorded in server and application logs, and temporary counters of login and
                password reset attempts used to prevent abuse.</li>
        </ul>
        <p class="legal__text">
            We do not process special categories of data. Please do not put them in your tasks.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">3. Purposes and legal bases</h2>
        <ul class="legal__list">
            <li class="legal__item"><strong>Creating and maintaining your account and providing the
                service</strong> (task management, signing in, password reset) — Article 6(1)(b) GDPR
                (performance of a contract for electronically supplied services).</li>
            <li class="legal__item"><strong>Keeping the service secure</strong>, including protection against
                password guessing and abuse — Article 6(1)(f) GDPR (the Controller’s legitimate interest).</li>
            <li class="legal__item"><strong>Establishing, exercising or defending legal claims</strong> and
                demonstrating acceptance of the privacy policy — Article 6(1)(f) GDPR.</li>
        </ul>
        <p class="legal__text">
            Providing your data is voluntary, but necessary to create an account and use the service. We do not
            make automated decisions about you and do not profile you.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">4. Recipients</h2>
        <p class="legal__text">
            We do not sell your data or share it for marketing. Only entities processing data on behalf of the
            Controller under a data processing agreement may have access to it:
        </p>
        <ul class="legal__list">
            <li class="legal__item">the hosting provider running the service and its database (servers located
                in the European Union),</li>
            <li class="legal__item">the email delivery provider used to send password reset links.</li>
        </ul>
        <p class="legal__text">
            Data may be disclosed to public authorities only where required by law.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">5. Transfers outside the EEA</h2>
        <p class="legal__text">
            As a rule we do not transfer data outside the European Economic Area. Should any provider process data
            outside the EEA, it will happen only on the basis of a European Commission adequacy decision or the
            standard contractual clauses approved by the Commission. You can obtain a copy of these safeguards
            by writing to the Controller.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">6. How long we keep data</h2>
        <ul class="legal__list">
            <li class="legal__item"><strong>Account data and tasks</strong> — until the account is deleted.
                After deletion the data is removed from the database and disappears from backups as they rotate,
                no later than after 30 days.</li>
            <li class="legal__item"><strong>Password reset token</strong> — valid for 60 minutes. Removed once used, and an unused
                one is deleted automatically within an hour of expiring.</li>
            <li class="legal__item"><strong>Login and password reset attempt counters</strong> — up to
                1 hour.</li>
            <li class="legal__item"><strong>Server and application logs</strong> — no longer than 30 days, unless needed to
                investigate a security incident.</li>
        </ul>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">7. Your rights</h2>
        <p class="legal__text">You have the right to:</p>
        <ul class="legal__list">
            <li class="legal__item">access your data and receive a copy of it (Article 15 GDPR),</li>
            <li class="legal__item">rectify your data (Article 16 GDPR),</li>
            <li class="legal__item">erasure, including deleting your account (Article 17 GDPR),</li>
            <li class="legal__item">restriction of processing (Article 18 GDPR),</li>
            <li class="legal__item">data portability (Article 20 GDPR),</li>
            <li class="legal__item">object to processing based on legitimate interest (Article 21 GDPR).</li>
        </ul>
        <p class="legal__text">
            You can delete your account together with all your tasks at any time yourself, in your profile
            (the “Delete account” button). To exercise your other rights, write to
            <a class="legal__link" href="mailto:<?= h($contactEmail) ?>"><?= h($contactEmail) ?></a>
            from the email address linked to your account. We will respond without undue delay and within one
            month at the latest.
        </p>
        <p class="legal__text">
            You also have the right to lodge a complaint with the President of the Personal Data Protection
            Office (Prezes Urzędu Ochrony Danych Osobowych, ul. Stawki 2, 00-193 Warsaw, Poland) or with the
            supervisory authority of your country of residence.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">8. Cookies</h2>
        <p class="legal__text">
            The service uses only cookies strictly necessary for it to work, which do not require consent:
        </p>
        <ul class="legal__list">
            <li class="legal__item"><strong>PHPSESSID</strong> — session cookie that keeps you signed in and
                carries the messages shown after an action;
                expires when you close the browser, and signing out ends the session.</li>
            <li class="legal__item"><strong>csrfToken</strong> — protects forms against Cross-Site Request
                Forgery; expires when you close the browser.</li>
        </ul>
        <p class="legal__text">
            We do not use analytics, advertising or third-party cookies. Fonts and other page assets are served
            from our own server, so visiting the service does not connect you to any external provider. You can
            block cookies in your browser settings, but signing in will then not work.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">9. Security</h2>
        <p class="legal__text">
            Connections to the service are encrypted (HTTPS), passwords are stored only as cryptographic hashes,
            and the number of login and password reset attempts is limited. Only the Controller and, to the extent needed to
            maintain the servers, the hosting provider have access to the database.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">10. Changes to this policy</h2>
        <p class="legal__text">
            This policy may be updated, for example because of changes in the law or in the service. The current
            version is always available on this page together with the date it takes effect. We will notify
            registered users of significant changes by email.
        </p>
    </section>
</article>
