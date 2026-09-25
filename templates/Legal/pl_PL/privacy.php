<?php
$this->assign('title', 'Polityka prywatności');
$this->Html->css('legalStyle', ['block' => true]);
?>

<article class="legal">
    <header class="legal__header">
        <h1 class="legal__title">Polityka prywatności</h1>
        <p class="legal__meta">Obowiązuje od 24 września 2026 r.</p>
    </header>

    <p class="legal__lead">
        Ten dokument wyjaśnia, jakie dane osobowe przetwarza serwis TaskHub, w jakim celu, jak długo je
        przechowujemy i jakie prawa Ci przysługują. Stanowi realizację obowiązku informacyjnego z art. 13
        Rozporządzenia Parlamentu Europejskiego i Rady (UE) 2016/679 (RODO).
    </p>

    <section class="legal__section">
        <h2 class="legal__heading">1. Administrator danych</h2>
        <p class="legal__text">
            Administratorem Twoich danych osobowych jest <?= h($administrator) ?>, <?= h($address) ?>
            (dalej: „Administrator”).
        </p>
        <p class="legal__text">
            We wszystkich sprawach dotyczących danych osobowych możesz skontaktować się z Administratorem pod
            adresem e-mail:
            <a class="legal__link" href="mailto:<?= h($contactEmail) ?>"><?= h($contactEmail) ?></a>.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">2. Jakie dane przetwarzamy</h2>
        <ul class="legal__list">
            <li class="legal__item"><strong>Dane konta:</strong> imię, adres e-mail, hasło (przechowywane
                wyłącznie w postaci skrótu kryptograficznego — nikt, również Administrator, nie zna Twojego
                hasła), wybrany awatar oraz data utworzenia konta i akceptacji polityki prywatności.</li>
            <li class="legal__item"><strong>Treści, które dodajesz:</strong> zadania wraz z tytułem, opisem,
                statusem, priorytetem i terminem.</li>
            <li class="legal__item"><strong>Dane resetu hasła:</strong> jednorazowy token wysyłany na Twój
                adres e-mail, gdy skorzystasz z funkcji „Nie pamiętam hasła”.</li>
            <li class="legal__item"><strong>Dane techniczne:</strong> adres IP i informacje o żądaniu
                (m.in. data, adres podstrony, przeglądarka) zapisywane w logach serwera i aplikacji oraz tymczasowe liczniki
                prób logowania i resetu hasła, służące ochronie przed nadużyciami.</li>
        </ul>
        <p class="legal__text">
            Nie przetwarzamy szczególnych kategorii danych. Prosimy, nie umieszczaj ich w treści zadań.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">3. Cele i podstawy prawne przetwarzania</h2>
        <ul class="legal__list">
            <li class="legal__item"><strong>Założenie i prowadzenie konta oraz świadczenie usługi</strong>
                (zarządzanie zadaniami, logowanie, reset hasła) — art. 6 ust. 1 lit. b RODO (wykonanie umowy
                o świadczenie usług drogą elektroniczną).</li>
            <li class="legal__item"><strong>Zapewnienie bezpieczeństwa serwisu</strong>, w tym ochrona przed
                próbami odgadnięcia hasła i nadużyciami — art. 6 ust. 1 lit. f RODO (prawnie uzasadniony interes
                Administratora).</li>
            <li class="legal__item"><strong>Ustalenie, dochodzenie lub obrona roszczeń</strong> oraz
                wykazanie akceptacji polityki prywatności — art. 6 ust. 1 lit. f RODO.</li>
        </ul>
        <p class="legal__text">
            Podanie danych jest dobrowolne, ale niezbędne do założenia konta i korzystania z serwisu.
            Nie podejmujemy wobec Ciebie decyzji w sposób zautomatyzowany i nie profilujemy Cię.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">4. Odbiorcy danych</h2>
        <p class="legal__text">
            Nie sprzedajemy Twoich danych ani nie udostępniamy ich w celach marketingowych. Dostęp do danych
            mogą mieć wyłącznie podmioty, które przetwarzają je w imieniu Administratora na podstawie umowy
            powierzenia:
        </p>
        <ul class="legal__list">
            <li class="legal__item">dostawca hostingu, na którego serwerach działa serwis i baza danych
                (serwery zlokalizowane w Unii Europejskiej),</li>
            <li class="legal__item">dostawca usługi wysyłki wiadomości e-mail, za pomocą której wysyłamy
                wiadomości z linkiem do resetu hasła.</li>
        </ul>
        <p class="legal__text">
            Dane mogą zostać udostępnione organom publicznym wyłącznie wtedy, gdy wynika to z przepisów prawa.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">5. Przekazywanie danych poza EOG</h2>
        <p class="legal__text">
            Co do zasady nie przekazujemy danych poza Europejski Obszar Gospodarczy. Jeżeli którykolwiek
            z dostawców będzie przetwarzał dane poza EOG, nastąpi to wyłącznie na podstawie decyzji Komisji
            Europejskiej stwierdzającej odpowiedni stopień ochrony lub standardowych klauzul umownych
            zatwierdzonych przez Komisję. Kopię zabezpieczeń możesz otrzymać, pisząc do Administratora.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">6. Jak długo przechowujemy dane</h2>
        <ul class="legal__list">
            <li class="legal__item"><strong>Dane konta i zadania</strong> — do czasu usunięcia konta.
                Po usunięciu konta dane są kasowane z bazy, a z kopii zapasowych znikają w ramach ich
                rotacji, nie później niż po 30 dniach.</li>
            <li class="legal__item"><strong>Token resetu hasła</strong> — jest ważny przez 60 minut. Usuwamy go po wykorzystaniu,
                a niewykorzystany — automatycznie w ciągu godziny od wygaśnięcia.</li>
            <li class="legal__item"><strong>Liczniki prób logowania i resetu hasła</strong> — maksymalnie
                1 godzinę.</li>
            <li class="legal__item"><strong>Logi serwera i aplikacji</strong> — nie dłużej niż 30 dni, chyba że są
                potrzebne do wyjaśnienia incydentu bezpieczeństwa.</li>
        </ul>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">7. Twoje prawa</h2>
        <p class="legal__text">W związku z przetwarzaniem danych przysługuje Ci prawo do:</p>
        <ul class="legal__list">
            <li class="legal__item">dostępu do swoich danych i otrzymania ich kopii (art. 15 RODO),</li>
            <li class="legal__item">sprostowania danych (art. 16 RODO),</li>
            <li class="legal__item">usunięcia danych, w tym usunięcia konta (art. 17 RODO),</li>
            <li class="legal__item">ograniczenia przetwarzania (art. 18 RODO),</li>
            <li class="legal__item">przenoszenia danych (art. 20 RODO),</li>
            <li class="legal__item">wniesienia sprzeciwu wobec przetwarzania opartego na prawnie
                uzasadnionym interesie (art. 21 RODO).</li>
        </ul>
        <p class="legal__text">
            Konto wraz ze wszystkimi zadaniami możesz w każdej chwili usunąć samodzielnie w swoim profilu
            (przycisk „Usuń konto”). Aby skorzystać z pozostałych praw, napisz na adres
            <a class="legal__link" href="mailto:<?= h($contactEmail) ?>"><?= h($contactEmail) ?></a>
            z adresu e-mail przypisanego do konta. Odpowiemy bez zbędnej zwłoki, nie później niż w ciągu
            miesiąca.
        </p>
        <p class="legal__text">
            Masz również prawo wnieść skargę do Prezesa Urzędu Ochrony Danych Osobowych
            (ul. Stawki 2, 00-193 Warszawa), jeśli uważasz, że przetwarzanie Twoich danych narusza RODO.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">8. Pliki cookies</h2>
        <p class="legal__text">
            Serwis używa wyłącznie plików cookies niezbędnych do jego działania, które nie wymagają zgody
            (art. 399 ustawy z dnia 12 lipca 2024 r. — Prawo komunikacji elektronicznej):
        </p>
        <ul class="legal__list">
            <li class="legal__item"><strong>PHPSESSID</strong> — cookie sesyjne, utrzymuje zalogowanie i komunikaty wyświetlane po wykonaniu akcji;
                wygasa po zamknięciu przeglądarki, a wylogowanie kończy sesję.</li>
            <li class="legal__item"><strong>csrfToken</strong> — chroni formularze przed atakami typu
                Cross-Site Request Forgery; wygasa po zamknięciu przeglądarki.</li>
        </ul>
        <p class="legal__text">
            Nie używamy cookies analitycznych, reklamowych ani cookies podmiotów trzecich. Czcionki i pozostałe
            zasoby strony są ładowane z naszego serwera, więc odwiedzając serwis nie łączysz się z serwerami
            zewnętrznych dostawców. Możesz zablokować cookies w ustawieniach przeglądarki, ale wtedy logowanie
            nie będzie działać.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">9. Bezpieczeństwo</h2>
        <p class="legal__text">
            Połączenie z serwisem jest szyfrowane (HTTPS), hasła są przechowywane wyłącznie w postaci skrótu
            kryptograficznego, a liczba prób logowania i resetu hasła jest ograniczona. Dostęp do bazy danych ma wyłącznie Administrator
            oraz, w zakresie niezbędnym do utrzymania serwerów, dostawca hostingu.
        </p>
    </section>

    <section class="legal__section">
        <h2 class="legal__heading">10. Zmiany polityki prywatności</h2>
        <p class="legal__text">
            Polityka może być aktualizowana, np. w związku ze zmianą przepisów lub funkcji serwisu. Aktualna
            wersja jest zawsze dostępna na tej stronie wraz z datą, od której obowiązuje. O istotnych
            zmianach poinformujemy zarejestrowanych użytkowników wiadomością e-mail.
        </p>
    </section>
</article>
