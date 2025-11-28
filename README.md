# Bmb/PageText

**Bmb/PageText** ist ein wiederverwendbares Composer-Package für Laravel + Filament v4, das das Verwalten von dynamischen Seiten-Texten vereinfacht.  
Es bietet eine Filament-Resource für das Backend, Caching der Texte und einen Blade-Helper für den einfachen Zugriff in deinen Views.

---

## Features

- Model `PageText` mit den Feldern:
  - `key` (string, unique)
  - `label` (string)
  - `text` (text)
- Blade Helper `page_text('key')` für schnellen Zugriff
- Automatisches Caching pro Key (1 Stunde)
- Cache wird beim Speichern oder Löschen eines Textes automatisch invalidiert
- Vollständig PSR-4-konform, Laravel-ready

---

## Installation

### 1. Über Git

Füge dein Package als VCS Repository hinzu (z.B. GitHub):

```json
// composer.json im Laravel-Projekt
"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:hausladc/bmb-page-text.git"
    }
]
```

Via Composer installieren:
```bash
# composer require bmb/page-text:dev-main
```

Dann Migration ausführen:
```bash
# php artisan migrate
```

Filament Resource erstellen:
```
# php artisan make:filament-resource PageText --generate --model-namespace= Bmb\\PageText\\Models
```

## Verwendung

### Blade Template

```php
<!-- Standard: gibt den Text inkl. HTML aus -->
{!! page_text('footer_text') !!}

<!-- Optional: Text ohne HTML -->
{{ page_text('footer_text', true) }}

<!-- Mit Fallback, falls der Key nicht existiert -->
{{ page_text('header_text', false, 'Standard-Text') }}
```

**Hinweis:** Die Texte werden automatisch für 1 Stunde gecached. Änderungen über die Filament Resource oder Seeder invalidieren den Cache automatisch.
