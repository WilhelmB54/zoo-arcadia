// Attend que le DOM soit entièrement chargé
document.addEventListener("DOMContentLoaded", () => {
  console.log("Document loaded");

  // Données des habitats avec leurs détails
  const habitatsData = [
    {
      name: "Savane",
      images: ["images/habitats/savane1.jpg"],
      description:
        "La savane du Zoo Arcadia représente un écosystème vaste et diversifié, typique des vastes plaines africaines. Ici, la nature s'épanouit dans un cadre où la coexistence entre les prédateurs majestueux et les herbivores grégaires est préservée. Nous avons soigneusement intégré des pratiques écologiques avancées pour minimiser notre empreinte carbone, de la gestion durable des terres à l'utilisation d'énergies renouvelables. Chaque visite à notre savane vous permet de découvrir non seulement la beauté de la faune africaine, mais aussi notre engagement envers un environnement durable.",
      animals: [
        {
          name: "Leo",
          species: "Lion",
          images: ["images/animals/lion1.jpg"],
          health: {
            status: "Bon",
            food: "Viande",
            foodAmount: "5 kg",
            lastCheckup: "2024-06-25",
            details: "Leo, le lion, est en pleine forme. Il dévore !",
          },
        },
        {
          name: "Tigrou",
          species: "Tigre",
          images: ["images/animals/tigre1.jpg"],
          health: {
            status: "Bon",
            food: "Viande",
            foodAmount: "8 kg",
            lastCheckup: "2024-06-22",
            details:
              "Tigrou, le tigre, est en bonne santé. Il aime courir vite.",
          },
        },
      ],
    },
    {
      name: "Jungle",
      images: ["images/habitats/jungle1.jpg"],
      description:
        "Notre jungle est un éden tropical où la biodiversité foisonne parmi les frondaisons luxuriantes et les murmures des cours d'eau. Au Zoo Arcadia, la jungle n'est pas seulement un habitat, c'est un symbole de notre engagement envers la conservation et la durabilité. Nous sommes fiers d'être autosuffisants en énergie, utilisant des sources renouvelables pour alimenter nos installations et préserver ce trésor de la nature. Explorez ce paradis vert et laissez-vous inspirer par notre dévouement à la préservation des écosystèmes fragiles.",
      animals: [
        {
          name: "Paco",
          species: "Perroquet",
          images: ["images/animals/perroquet1.jpg"],
          health: {
            status: "Bon",
            food: "Graines et fruits",
            foodAmount: "200 g",
            lastCheckup: "2024-06-20",
            details:
              "Paco, le perroquet, est très actif. Il parle tout le temps.",
          },
        },
        {
          name: "Bamboo",
          species: "Panda",
          images: ["images/animals/panda1.jpg"],
          health: {
            status: "Bon",
            food: "Bambou",
            foodAmount: "10 kg",
            lastCheckup: "2024-06-24",
            details:
              "Bamboo, le panda, est en pleine forme. Il aime se la couler douce.",
          },
        },
      ],
    },
    {
      name: "Marais",
      images: ["images/habitats/marais1.jpg"],
      description:
        "Le marais du Zoo Arcadia est un refuge tranquille pour une diversité remarquable d'animaux aquatiques et de plantes adaptées à des conditions humides et changeantes. En harmonie avec notre mission écologique, nous utilisons des technologies innovantes pour gérer efficacement les ressources naturelles et minimiser notre impact environnemental. Chaque pas à travers nos sentiers de marais vous connecte à la magie de la vie aquatique tout en reflétant notre engagement envers un avenir durable pour les générations futures.",
      animals: [
        {
          name: "Croco",
          species: "Crocodile",
          images: ["images/animals/crocodile1.jpg"],
          health: {
            status: "Bon",
            food: "Poisson",
            foodAmount: "3 kg",
            lastCheckup: "2024-06-23",
            details: "Croco, le crocodile, à une faim de loup. Il croque !",
          },
        },
      ],
    },
  ];

  // Récupération des éléments HTML où les données seront affichées
  const habitatsContainer = document.getElementById("habitatsContainer");
  const habitatDetails = document.getElementById("habitatDetails");

  // Fonction pour afficher tous les habitats
  function showHabitats() {
    habitatsContainer.innerHTML = "";
    habitatDetails.classList.add("hidden");

    // Crée une carte pour chaque habitat
    habitatsData.forEach((habitat, index) => {
      console.log(`Adding habitat: ${habitat.name}`);
      const card = document.createElement("div");
      card.classList.add("card");
      card.dataset.index = index;

      // Ajoute une image représentant l'habitat
      const image = document.createElement("img");
      image.src = habitat.images[0];
      image.alt = habitat.name;

      // Ajoute le nom de l'habitat comme titre
      const name = document.createElement("h3");
      name.textContent = habitat.name;

      // Ajoute l'image et le nom à la carte
      card.appendChild(image);
      card.appendChild(name);
      // Ajoute un écouteur de clic pour afficher les détails de l'habitat
      card.addEventListener("click", () => {
        showHabitatDetails(index);
        history.pushState(
          { page: "habitat", index: index },
          null,
          `#${habitat.name.toLowerCase()}`
        );
      });

      // Ajoute la carte à la liste des habitats
      habitatsContainer.appendChild(card);
    });
  }

  // Fonction pour afficher les détails d'un habitat spécifique
  function showHabitatDetails(index) {
    const habitat = habitatsData[index];
    console.log(`Showing details for habitat: ${habitat.name}`);
    habitatsContainer.innerHTML = "";
    habitatDetails.innerHTML = "";
    habitatDetails.classList.remove("hidden");

    // Ajoute le titre de l'habitat
    const title = document.createElement("h2");
    title.textContent = habitat.name;

    // Crée un conteneur pour les images de l'habitat
    const imagesContainer = document.createElement("div");
    imagesContainer.classList.add("images-container");
    habitat.images.forEach((imgSrc) => {
      const img = document.createElement("img");
      img.src = imgSrc;
      img.alt = habitat.name;
      img.classList.add("rounded-image");
      imagesContainer.appendChild(img);
    });

    // Ajoute la description de l'habitat
    const description = document.createElement("p");
    description.textContent = habitat.description;

    // Ajoute le titre, les images et la description au conteneur des détails
    habitatDetails.appendChild(title);
    habitatDetails.appendChild(imagesContainer);
    habitatDetails.appendChild(description);

    // Ajoute chaque animal de l'habitat avec ses détails
    habitat.animals.forEach((animal) => {
      console.log(`Adding animal: ${animal.name}`);
      const animalCard = document.createElement("div");
      animalCard.classList.add("animal-card");

      const animalImg = document.createElement("img");
      animalImg.src = animal.images[0];
      animalImg.alt = animal.name;

      const animalName = document.createElement("h3");
      animalName.textContent = animal.name;
      animalName.classList.add("animal-name");

      const animalSpecies = document.createElement("p");
      animalSpecies.textContent = `Race: ${animal.species}`;

      const animalHealth = document.createElement("p");
      animalHealth.textContent = `État: ${animal.health.status}`;

      const animalFood = document.createElement("p");
      animalFood.textContent = `Nourriture: ${animal.health.food}, ${animal.health.foodAmount}`;

      const animalLastCheckup = document.createElement("p");
      animalLastCheckup.textContent = `Dernier contrôle: ${animal.health.lastCheckup}`;

      animalCard.appendChild(animalImg);
      animalCard.appendChild(animalName);
      animalCard.appendChild(animalSpecies);
      animalCard.appendChild(animalHealth);
      animalCard.appendChild(animalFood);
      animalCard.appendChild(animalLastCheckup);

      // Ajoute un écouteur de clic pour afficher les détails de l'animal
      animalCard.addEventListener("click", () => {
        showAnimalDetails(animal);
        history.pushState({ page: "animal", animal: animal }, null, "");
      });

      // Ajoute la carte de l'animal aux détails de l'habitat
      habitatDetails.appendChild(animalCard);
    });
  }

  // Fonction pour afficher les détails d'un animal spécifique
  function showAnimalDetails(animal) {
    console.log(`Showing details for animal: ${animal.name}`);
    habitatDetails.innerHTML = "";

    // Ajoute le titre de l'animal
    const title = document.createElement("h2");
    title.textContent = animal.name;

    // Ajoute la race de l'animal
    const species = document.createElement("p");
    species.textContent = `Race: ${animal.species}`;

    // Crée un conteneur pour les images de l'animal
    const imagesContainer = document.createElement("div");
    imagesContainer.classList.add("images-container");
    animal.images.forEach((imgSrc) => {
      const img = document.createElement("img");
      img.src = imgSrc;
      img.alt = animal.name;
      img.classList.add("rounded-image");
      imagesContainer.appendChild(img);
    });

    // Ajoute l'état de santé de l'animal
    const healthStatus = document.createElement("p");
    healthStatus.textContent = `État: ${animal.health.status}`;

    // Ajoute les informations sur la nourriture de l'animal
    const foodInfo = document.createElement("p");
    foodInfo.textContent = `Nourriture: ${animal.health.food}, ${animal.health.foodAmount}`;

    // Ajoute la date du dernier contrôle de l'animal
    const lastCheckup = document.createElement("p");
    lastCheckup.textContent = `Dernier contrôle: ${animal.health.lastCheckup}`;

    // Ajoute les détails spécifiques sur la santé de l'animal
    const details = document.createElement("p");
    details.textContent = `${animal.health.details}`;

    // Ajoute tous les éléments créés aux détails de l'habitat
    habitatDetails.appendChild(title);
    habitatDetails.appendChild(species);
    habitatDetails.appendChild(imagesContainer);
    habitatDetails.appendChild(healthStatus);
    habitatDetails.appendChild(foodInfo);
    habitatDetails.appendChild(lastCheckup);
    habitatDetails.appendChild(details);
  }

  // Gestion de l'historique de navigation
  window.addEventListener("popstate", (event) => {
    if (event.state) {
      if (event.state.page === "habitat") {
        showHabitatDetails(event.state.index);
      } else if (event.state.page === "animal") {
        showAnimalDetails(event.state.animal);
      }
    } else {
      const hash = window.location.hash.substring(1);
      if (hash) {
        const habitatIndex = habitatsData.findIndex(
          (h) => h.name.toLowerCase() === hash
        );
        if (habitatIndex !== -1) {
          showHabitatDetails(habitatIndex);
        } else {
          showHabitats();
        }
      } else {
        showHabitats();
      }
    }
  });

  // Gestion des clics sur les liens d'habitats
  const hash = window.location.hash.substring(1);
  if (hash) {
    const habitatIndex = habitatsData.findIndex(
      (h) => h.name.toLowerCase() === hash
    );
    if (habitatIndex !== -1) {
      showHabitatDetails(habitatIndex);
    } else {
      showHabitats();
    }
  } else {
    showHabitats();
  }
});
