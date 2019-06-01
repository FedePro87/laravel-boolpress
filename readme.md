# Boolpress
Boolpress è un progetto creato in Laravel che strizza l'occhio a un blog vero e proprio.

### Caratteristiche
- Attraverso l'utilizzo degli strumenti forniti da Laravel fornisce la possibilità di creare post in modo del tutto casuale grazie alle Migration,ai Factory e ai Seeder.
- Sfrutta l'ORM Eloquent per creare delle semplici associazioni tra entità. Implementa due tipologie di relazioni: Nam (Post e Categorie) e 1aM(Autore e Post).
- L'architettura modulare di Laravel fa sì che si possano creare diverse Route senza doversi preoccupare di riscrivere ogni volta il codice relativo a entità in comune (per esempio footer e header).
- è possibile utilizzare i link per accedere alle CRUD, che ancora una volta sfrutterano le ORM per lavorare facilmente con il database.
- Presenza di una pagina di ricerca avanzata tra i post. è possibile indicare allo stesso tempo 4 parametri diversi (titolo, contenuto, autore e categoria).

## Tecnologie usate
HTML,JS,Jquery,Laravel (Blade, Eloquent, Webpack).
