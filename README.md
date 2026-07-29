<p align="center">
  <img src="assets/logo-social-share.png" alt="Perugia: Città del Cioccolato - La Guida Indipendente" width="720">
</p>

<h1 align="center">Perugia: Città del Cioccolato</h1>

<p align="center">
  Guida editoriale indipendente dedicata a Perugia, alla sua tradizione cioccolatiera e al patrimonio culturale della città.
</p>

<p align="center">
  <a href="https://cittàdelcioccolato.it/">Sito online</a>
  ·
  <a href="https://cittàdelcioccolato.it/chi-siamo.html">Chi siamo</a>
  ·
  <a href="LICENSE">Licenza GPL-3.0</a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/HTML5-statico-E34F26?logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-responsive-1572B6?logo=css3&logoColor=white" alt="CSS3">
  <img src="https://img.shields.io/badge/JavaScript-vanilla-F7DF1E?logo=javascript&logoColor=111" alt="JavaScript">
  <img src="https://img.shields.io/badge/PHP-form_email-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/licenza-GPL--3.0-blue" alt="Licenza GPL-3.0">
</p>

## Il progetto

Il sito raccoglie contenuti e strumenti per organizzare una visita a Perugia:

- guide al centro storico, ai musei del cioccolato e al patrimonio artistico;
- itinerari per weekend, visite giornaliere e famiglie;
- esperienze prenotabili tramite link affiliati dichiarati;
- guide digitali vendute e distribuite tramite Gumroad;
- informazioni per attività interessate a pubblicità e partnership.

Il progetto è indipendente e non rappresenta musei, aziende, eventi o istituzioni citati nelle pagine. Per orari, prezzi e prenotazioni vengono indicati, quando disponibili, i rispettivi siti ufficiali.

## Architettura

Non sono presenti framework, package manager, database o processo di build. Il progetto è composto da pagine HTML multipagina, un foglio di stile condiviso, JavaScript vanilla e un endpoint PHP per il form pubblicitario.

| Componente | Funzione |
| --- | --- |
| HTML5 | Contenuti e struttura delle pagine |
| CSS3 | Design responsive e componenti condivisi |
| JavaScript | Consenso cookie, caricamento condizionale di Google Analytics e invio asincrono del form |
| PHP | Validazione del form e invio email tramite `mail()` |
| Google Fonts | `Inter` e `Playfair Display` |
| Gumroad | Vendita e distribuzione delle guide PDF |
| GetYourGuide / Viator | Esperienze e collegamenti affiliati |

## Avvio locale

### Anteprima completa con PHP

È il metodo consigliato perché rende disponibile anche `send.php`.

Requisiti:

- PHP 7.4 o successivo;
- un sistema di invio email configurato, se si vuole provare realmente il form.

```bash
git clone https://github.com/jacmos3/cioccolato-www.git
cd cioccolato-www
php -S 127.0.0.1:8000
```

Apri [http://127.0.0.1:8000](http://127.0.0.1:8000).

Il server integrato di PHP permette di verificare la richiesta al backend, ma `mail()` può comunque fallire in locale se non è configurato un trasporto email.

### Sola anteprima statica

Per controllare layout, navigazione e contenuti senza usare PHP:

```bash
python3 -m http.server 8000 --bind 127.0.0.1
```

Con questa modalità il form pubblicitario non può essere inviato.

## Configurazione

### Form email

Il form presente in `pubblicita.html` invia i dati a `send.php` tramite `fetch()`. Il destinatario è configurato all'inizio del file:

```php
$email_destinatario = 'support@semproxlab.it';
```

In produzione il server deve:

- eseguire PHP;
- consentire l'uso di `mail()` o fornire un trasporto email equivalente;
- autorizzare il mittente `noreply@cittadelcioccolato.it`;
- servire le risposte JSON restituite da `send.php`.

### Cookie e analytics

`assets/cookie-consent.js` gestisce il consenso nel browser tramite la chiave `cookie_consent` in `localStorage`. Google Analytics viene caricato solo dopo l'accettazione dell'utente.

L'identificativo GA4 è definito nella costante:

```js
const GA_ID = 'G-0GL8LJX691';
```

Se si cambia proprietà Analytics, occorre aggiornare questa costante e verificare che Cookie Policy e Privacy Policy restino coerenti.

## SEO e condivisione

Il repository include:

- title, description e URL canonical nelle pagine;
- metadati Open Graph e Twitter Card nelle principali landing page;
- immagini social in formato PNG e SVG;
- `robots.txt` e `sitemap.xml`;
- favicon SVG/PNG e icona Apple Touch;
- dominio internazionalizzato `cittàdelcioccolato.it`.

Quando si aggiunge o si rinomina una pagina pubblica, vanno aggiornati almeno navigazione, footer, `sitemap.xml`, canonical e collegamenti interni.

## Struttura del repository

```text
.
├── index.html                 # Homepage
├── centro-storico.html        # Guida al centro storico
├── museo-cioccolato.html      # Confronto tra i musei del cioccolato
├── arte-cultura.html          # Arte, musei e luoghi culturali
├── itinerari.html             # Itinerari di visita
├── guide-pdf.html             # Catalogo e vendita delle guide digitali
├── chi-siamo.html             # Identità e indipendenza editoriale
├── pubblicita.html            # Offerta pubblicitaria e form di contatto
├── privacy.html               # Privacy Policy
├── cookie.html                # Cookie Policy
├── termini.html               # Termini e condizioni
├── send.php                   # Backend del form email
├── robots.txt
├── sitemap.xml
├── LICENSE
└── assets/
    ├── style.css              # Stili condivisi e layout responsive
    ├── cookie-consent.js      # Consenso cookie e caricamento GA4
    ├── favicon.svg
    ├── favicon-16.png
    ├── favicon-32.png
    ├── apple-touch-icon.png
    ├── logo-social.svg
    ├── logo-social.png
    ├── logo-social-share.svg
    └── logo-social-share.png
```

## Pubblicazione

Il deploy non richiede compilazione. È sufficiente pubblicare il contenuto del repository nella document root di un hosting con supporto PHP.

Prima della pubblicazione:

1. verificare i link ufficiali e i collegamenti affiliati;
2. controllare canonical, metadati social e `sitemap.xml`;
3. provare il form su un ambiente con email configurata;
4. verificare accettazione e rifiuto dei cookie in una sessione pulita;
5. controllare homepage e pagine principali su desktop e mobile;
6. aggiornare le date `lastmod` della sitemap per i contenuti modificati.

## Servizi esterni

Il sito può collegarsi o affidarsi a servizi di terze parti:

- Google Fonts e Google Analytics;
- Gumroad per acquisto e download delle guide;
- GetYourGuide e Viator per link affiliati;
- siti ufficiali di musei, eventi, strutture e istituzioni.

Disponibilità, contenuti e condizioni di questi servizi non sono controllati dal repository. I link commerciali devono mantenere attributi coerenti, come `rel="noopener sponsored"`.

## Licenza

Il progetto è distribuito secondo i termini della [GNU General Public License v3.0](LICENSE).
