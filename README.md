## Przegląd systemu filtrów
System filtrów w aplikacji zapewnia elastyczne i wydajne narzędzie do filtrowania danych na podstawie zdefiniowanych kryteriów. Używamy wzorca fasady do uproszczenia interfejsów używanych przez inne części systemu, jednocześnie zapewniając solidną walidację danych wejściowych.

### Architektura Filtrów
Filtry w aplikacji są zaimplementowane z wykorzystaniem kilku kluczowych koncepcji:

- **Fasada Filtrów:**
  Fasada (FilterFacade) dostarcza jednolity interfejs dla użytkowników systemu, ukrywając złożoność zarządzania różnymi filtrami i ich zależnościami. Dzięki fasadzie, tworzenie i stosowanie filtrów jest uproszczone, co pozwala na łatwe i szybkie wdrażanie nowych kryteriów filtracji.

- **Walidatory:**
  Każdy filtr korzysta z odpowiedniego walidatora do sprawdzania poprawności danych wejściowych. Walidatory pomagają w utrzymaniu danych wejściowych w zgodzie ze specyfikacją i zabezpieczają aplikację przed nieprawidłowymi danymi. W łatwy sposób jesteśmy wstanie dodać kolejne indywidualnie zdefiniowane filtry pod konkretne flow.

- **Łatwość dodawania nowych filtrów:**
  System filtrów został zaprojektowany z myślą o łatwej skalowalności i adaptacji. Dzięki modularnej budowie i zastosowaniu wzorca fasady, wprowadzenie nowych filtrów do systemu jest intuicyjne i nie wymaga głębokich zmian w istniejącej architekturze. Możliwość łatwego dodawania filtrów pozwala na szybkie dostosowanie aplikacji do zmieniających się wymagań biznesowych oraz integrację z nowymi rodzajami danych, które mogą wymagać filtrowania.

- **Praktyczność i elastyczność:**
  Modularność i wyraźne oddzielenie odpowiedzialności pozwalają na łatwe zarządzanie poszczególnymi elementami systemu filtrów. Każdy filtr może być rozwijany, testowany i wdrażany niezależnie, co zwiększa efektywność pracy zespołu programistycznego i umożliwia szybką reakcję na nowe wyzwania.

Korzystając z tak zaprojektowanego systemu, możemy efektywnie rozbudowywać naszą aplikację, zapewniając jednocześnie wysoki poziom personalizacji i dostosowania do specyficznych potrzeb użytkowników.

### Przykłady Użycia
Aby stworzyć nowe filtry, które zostaną wykorzystane przez repozytorium, należy skorzystać z fasady.
- tworzenie filtru tylko dla miasta:
```php
$filterFacade = new FilterFacade();
$cityFilter = $filterFacade->createCityFilter("Poznań");
$filters = Filters::of(cityFilter);
```

- tworzenie filtra z kilkoma kryteriami:
```php
$filterFacade = new FilterFacade();
$cityFilter = $filterFacade->createCityFilter("Poznań", "Kalisz");
$partnerIdFilter = $filterFacade->createPartnerIdFilter(0);
$filters = Filters::of($cityFilter, $partnerIdFilter);
```

Filtry są automatycznie skonfigurowane, walidowane i gotowe do użycia.
