# Abalo

**Projektarbeit** für das Modul **„Datenbanken und Webtechnologien 2“** im Studiengang **„Informatik“** an der **FH Aachen**.

## 🚀 Projektübersicht

Abalo ist ein Webprojekt, das mit dem **Laravel-Framework** entwickelt wurde und **PostgreSQL** als Datenbanksystem verwendet. Es demonstriert den Einsatz moderner Webtechnologien im Bereich Datenbankentwicklung und -anbindung.

---

## 🛠️ Technologien

- **Backend-Framework:** Laravel (PHP)
- **Datenbank:** PostgreSQL

---

## ⚙️ Einrichtung und Nutzung

### 1. Repository klonen

```bash
git clone <https://github.com/phuongmaiiii/project-abalo>
cd abalo
```

### 2. Abhängigkeiten installieren

```bash
composer install
```
### 3. Umgebungsdatei kopieren und anpassen

```bash
cp .env.example .env
```
Bearbeite `.env` und stelle sicher, dass die Datenbankinformationen korrekt sind:
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=abalo
DB_USERNAME=dev
DB_PASSWORD=<dein_passwort>
```

### 4. Anwendungsschlüssel generieren

```bash
php artisan key:generate
```

### 5. Migrationen ausführen (optional)

```bash
php artisan migrate
```

---

## 🖥️ Anwendung starten

```bash
php artisan serve
```
Rufe im Browser auf: `http://localhost:8000`

---

## 🧪 Verbindung zur Datenbank testen

```bash
psql -U dev -d abalo
```


