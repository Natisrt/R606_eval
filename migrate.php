<?php
$host = 'localhost';
$dbname = 'ma_bdd';
$user = 'db_user';
$pass = 'db_pwd';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (!file_exists($migrationsFile)) {
        echo "Fichier migrations.json non trouvé\n";
        exit(1);
    }

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations_history (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration_id VARCHAR(255) NOT NULL UNIQUE,
            applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_migration_id (migration_id)
        )
    ");

    $migrationsFile = __DIR__ . '/migrations/migrations.json';

    try {
        $pdo->exec($migrationScript);

        $stmt = $pdo->prepare("INSERT INTO migrations_history (migration_id) VALUES (?)");
        $stmt->execute([$migrationId]);
    } catch (PDOException $e) {
        echo "Erreur de migration '$migrationId': " . $e->getMessage() . "\n";
        exit(1);
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la db : " . $e->getMessage() . "\n";
    exit(1);
}
