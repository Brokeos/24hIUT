<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Coffee;
use App\Entity\Country;
use App\Entity\Groupe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){

        $this->passwordEncoder = $passwordEncoder;

    }

    public function load(ObjectManager $manager)
    {

        $exportateurs = array();
        $importateurs = array();
        $countries = array();

        #Groupes
        $group1 = new Groupe();

        $group1->setRole("ROLE_EXPORTATEUR");
        $group1->setDisplay("Exportateur");
        $group1->setInherited(null);
        $manager->persist($group1);

        $group2 = new Groupe();

        $group2->setRole("ROLE_IMPORTATEUR");
        $group2->setDisplay("Importateur");
        $group2->setInherited(null);
        $manager->persist($group2);


        $faker = Faker\Factory::create('fr_FR');

        $exportateur = new Account();

        $exportateur->setUsername("Exportateur");
        $exportateur->setPassword($this->passwordEncoder->encodePassword($exportateur, 'exportateur'));
        $exportateur->setOffice("Entreprise exportateur");
        $exportateur->setPhoneNumber("0677777777");
        $exportateur->setRole($group1);
        $manager->persist($exportateur);

        $importateur = new Account();

        $importateur->setUsername("Importateur");
        $importateur->setPassword($this->passwordEncoder->encodePassword($importateur, 'importateur'));
        $importateur->setOffice("Entreprise importateur");
        $importateur->setPhoneNumber("0666666666");
        $importateur->setRole($group2);
        $manager->persist($importateur);

        for($i = 0; $i < 10; $i++){

            $account = new Account();

            $account->setUsername($faker->userName);
            $account->setPassword($this->passwordEncoder->encodePassword($account, 'exportateur'));
            $account->setOffice($faker->company);
            $account->setPhoneNumber($faker->phoneNumber);
            $account->setRole($group1);
            $manager->persist($account);

            array_push($exportateurs, $account);

        }

        for($i = 0; $i < 10; $i++){

            $account = new Account();

            $account->setUsername($faker->userName);
            $account->setPassword($this->passwordEncoder->encodePassword($account, 'importateur'));
            $account->setOffice($faker->company);
            $account->setPhoneNumber($faker->phoneNumber);
            $account->setRole($group2);
            $manager->persist($account);

            array_push($importateurs, $account);

        }

        $madagascar= new Country();

        $madagascar->setName("Madagascar");
        $madagascar->setCapital("Tananarive");
        $madagascar->setFlag("MG");
        $madagascar->setCoffeeQuantity($faker->randomNumber(4));
        $madagascar->setInhabitants(24400000);
        $madagascar->setSurface(587041);
        $madagascar->setDescription("Durant vingt siècles, Madagascar a été façonnée par des peuples venant d'horizons divers : Afrique, Sud-Est asiatique (Indonésie), Proche-Orient, Europe… pour créer la société pluriculturelle malgache actuelle.<br/> À Madagascar, le café constitue une des principales ressources du pays et occupe la troisième place des produits agricoles exportés en entrée de devises après la vanille et les crustacés.<br/>");

        $manager->persist($madagascar);

        array_push($countries, $madagascar);

        $tanzanie = new Country();

        $tanzanie->setName("Tanzanie");
        $tanzanie->setCapital("Dodoma");
        $tanzanie->setFlag("TZ");
        $tanzanie->setCoffeeQuantity($faker->randomNumber(4));
        $tanzanie->setInhabitants(57300000);
        $tanzanie->setSurface(945087);
        $tanzanie->setDescription("Un pays d'Afrique de l'Est situé en bordure de l'océan Indien, dans la partie tropicale de l'hémisphère sud.<br/> Le café est un aspect important de son économie, car c'est une importante culture d'exportation du pays.<br/>");

        $manager->persist($tanzanie);
        array_push($countries, $tanzanie);
        $costaRica = new Country();

        $costaRica->setName("Costa Rica");
        $costaRica->setCapital("San josé");
        $costaRica->setFlag("CR");
        $costaRica->setCoffeeQuantity($faker->randomNumber(4));
        $costaRica->setInhabitants(5000000);
        $costaRica->setSurface(51000);
        $costaRica->setDescription("Une république constitutionnelle unitaire d’Amérique centrale, la majeure partie du Costa Rica est situé sur l’isthme centre-américain, comprend également l'île Cocos à plus de 500 kilomètres des côtes du pays, située dans l’océan Pacifique.<br/> Le rôle de café dans son économie s’avère important jusqu’en ce moment.<br/> Ce petit pays a fourni presque 1% de la production mondiale du café, soit 90 tonnes de café.<br/>");

        $manager->persist($costaRica);
        array_push($countries, $costaRica);
        $venezuela = new Country();

        $venezuela->setName("Vénézuela");
        $venezuela->setCapital("Caracas");
        $venezuela->setFlag("VE");
        $venezuela->setCoffeeQuantity($faker->randomNumber(4));
        $venezuela->setInhabitants(31600000);
        $venezuela->setSurface(916445);
        $venezuela->setDescription("Une république fédérale située dans la partie la plus septentrionale de l’Amérique du Sud, bordé au nord par la mer des Caraïbes, à l’est par la Guyane, au sud par le Brésil, au sud-ouest et à l’ouest par la Colombie.<br/> Les conquistadors espagnols venus du Venezuela avaient apporté beaucoup de ressources que les tribus ne connaissaient pas et leur ont permis de commencer à cultiver des grains de café.<br/>");

        $manager->persist($venezuela);
        array_push($countries, $venezuela);

        $bresil = new Country();

        $bresil->setName("Brésil");
        $bresil->setCapital("Brasilia");
        $bresil->setFlag("BR");
        $bresil->setCoffeeQuantity($faker->randomNumber(4));
        $bresil->setInhabitants(209300000);
        $bresil->setSurface(8515767);
        $bresil->setDescription("Le plus grand État d'Amérique du sud et d'amérique latine, il est le cinquième plus grand pays de la planète. Ce pays est considéré unique étant donné que sa langue officielle est le portugais, alors que la plupart des pays d’Amérique latine ont pour langue officielle l’espagnol.
        Grâce à sa gigantesque taille, ses plantations de café couvrent environ 27000 km2 ce qui fait de lui le plus grand producteur de café du monde, en représentant environ un tiers de la production.");

        $manager->persist($bresil);
        array_push($countries, $bresil);

        $vietNam = new Country();

        $vietNam->setName("VietNam");
        $vietNam->setCapital("Hanoï");
        $vietNam->setFlag("VN");
        $vietNam->setCoffeeQuantity($faker->randomNumber(4));
        $vietNam->setInhabitants(92700000);
        $vietNam->setSurface(330967);
        $vietNam->setDescription("Le Viêt Nam, ou en forme longue la république socialiste du Viêt Nam, est un pays d’Asie situé à l’est de la péninsule indochinoise. Cet État communiste est connu pour sa caféiculture qui date de l’ère de la colonisation française. Où les français, bénéficiant de son climat tropicale, ont apportés des plants de cafés. La production de café est devenue le revenu majeur pour ce pays depuis le début du XXème siècle.");

        $manager->persist($vietNam);
        array_push($countries, $vietNam);

        $indonesie = new Country();

        $indonesie->setName("Indonésie");
        $indonesie->setCapital("Jakarta");
        $indonesie->setFlag("ID");
        $indonesie->setCoffeeQuantity($faker->randomNumber(4));
        $indonesie->setInhabitants(261000000);
        $indonesie->setSurface(1904569);
        $indonesie->setDescription("Un pays transcontinental se trouvant en Asie du Sud-Est. Ce pays est le plus grand archipel du monde , il contient de plus 17000 îles. Il dispose aussi des ressources naturelles telles que le pétrole et le gaz naturel, le cuivre et l’or. Toutefois, la production de café est aussi importante chez elle, environ 6% de la production mondiale de café. La culture du café en Indonésie a commencé au début de la période coloniale néerlandaise.");

        $manager->persist($indonesie);
        array_push($countries, $indonesie);

        $colombie = new Country();

        $colombie->setName("Colombie");
        $colombie->setCapital("Bogota");
        $colombie->setFlag("CO");
        $colombie->setCoffeeQuantity($faker->randomNumber(4));
        $colombie->setInhabitants(50000000);
        $colombie->setSurface(1141748);
        $colombie->setDescription("La république de Colombie est située dans le Nord-Ouest de l’Amérique du Sud, bordé à l’ouest par l’océan Pacifique et le Panama. Ce pays est l’un des pays du monde les plus divers sur le plan ethnique et linguistique, avec son riche patrimoine culturel reflétant les influences des plusieurs facteurs comme la colonisation européenne. La production café annuelle moyenne de la Colombie est le 4eme plus élevé au monde, juste après le Brésil, le Viêt Nam, et l’Indonésie. Ce producteur est connu pour sa réputation de produire des grains de café doux et bien équilibrés.");

        $manager->persist($colombie);
        array_push($countries, $colombie);

        $inde = new Country();

        $inde->setName("Inde");
        $inde->setCapital("New Delhi");
        $inde->setFlag("IN");
        $inde->setCoffeeQuantity($faker->randomNumber(4));
        $inde->setInhabitants(1300000);
        $inde->setSurface(3287263);
        $inde->setDescription("L’un des pays connus pour sa puissance économique mondiale, l’Inde est forcément l’un des plus grand producteur de café, soit 5eme pour la production mondiale. Ce grand pays qui occupe la majeure partie du sous-continent indien, est classé le deuxième pays le plus peuplé du monde. La caféiculture en Inde est localisée sur les collines des États de l’Inde du Sud, et le café indien est réputé être le café cultivé à l’ombre le plus fin du monde.");

        $manager->persist($inde);
        array_push($countries, $inde);

        $philippines = new Country();

        $philippines->setName("Philippines");
        $philippines->setCapital("Manille");
        $philippines->setFlag("ph");
        $philippines->setCoffeeQuantity($faker->randomNumber(4));
        $philippines->setInhabitants(100998376);
        $philippines->setSurface(300439);
       $philippines->setDescription("Dans l’Asie du Sud-Est se trouve les philippines un archipel de 7 641 îles dont onze totalise plus de 90% des terres et dont un peu plus de 2 000 sont habitées.<br> Les philippines ont commencé leur production de café dès 1740.<br> Le café fut introduit par les Espagnols . Dans les années 1800-1900 les philippines fut la quatrième plus grande production de café du monde, cela ne dura pas en 2014, il son relégué à la 110eme place des pays producteurs.<br>
Malgré ça la demande local de café est extrêmement haute 100 000 tonnes consommées dans le pays par ans. Les philippines restent un des seuls pays à produire quatres variétés de café différentes.<br>
");

        $manager->persist($philippines);
        array_push($countries, $philippines);


        $nicaragua = new Country();

        $nicaragua->setName("Nicaragua");
        $nicaragua->setCapital("Managua");
        $nicaragua->setFlag("NI");
        $nicaragua->setCoffeeQuantity($faker->randomNumber(4));
        $nicaragua->setInhabitants(6000000);
        $nicaragua->setSurface(129494);
        $nicaragua->setDescription("Entouré de l’océan Pacifique et de la mer des Caraïbes, ce pays se trouvant en Amérique centrale avec la population multiethnique de six millions d’habitants comprend des personnes d’ascendance autochtone, européenne et africaine.<br> La production de café en Nicaragua est un composant important pour son histoire et même son économie.<br> Le café est l’une des principales exportation, avec la majeure partie du café cultivé dans le département de Managua.");

        $manager->persist($nicaragua);
        array_push($countries, $nicaragua);

        $laos = new Country();

        $laos->setName("Laos");
        $laos->setCapital("Vientiane");
        $laos->setFlag("LA");
        $laos->setCoffeeQuantity($faker->randomNumber(4));
        $laos->setInhabitants(7200000);
        $laos->setSurface(236800);
        $laos->setDescription("Un pays sans accès à la mer d'Asie du Sud-est, entouré par la Birmanie (ou Myanmar), la Thaïlande, le Cambodge, le Viêt Nam et la Chine. <br>Le café lao a une consistance épaisse et a une amertume marqué. <br>Il est souvent servi dans un verre, avec du lait concentré sucré au fond et un verre de thé lao pour pousser le café.<br>");

        $manager->persist($laos);
        array_push($countries, $laos);

        $cotedivoire = new Country();

        $cotedivoire->setName("Côte d’ivoire");
        $cotedivoire->setCapital("Yamoussoukro");
        $cotedivoire->setFlag("CI");
        $cotedivoire->setCoffeeQuantity($faker->randomNumber(4));
        $cotedivoire->setInhabitants(26594750);
        $cotedivoire->setSurface(322562);
        $cotedivoire->setDescription("Un pays d’afrique, il est membre de l’union africaine. <br>Pays en voie de développement, sa croissance est rapide.<br> Le pays est composé de 60 ethnies différentes.<br> Les plants de café ont été introduit dans le pays au 18ème siècle par les colonisateurs français. <br>Suite à la seconde Guerre mondial , la production de café a augmenté de 36 000 tonnes en 1945 à 112 500 tonnes en 1958.<br> Suite à cela dans les années 1970 à 1980, le pays était  le premier exportateur mondial de café robusta. En 2013, il est relégué à la 13eme place. ");

        $manager->persist($cotedivoire);
        array_push($countries, $cotedivoire);

        $chine = new Country();

        $chine->setName("Chine");
        $chine->setCapital("Pekin");
        $chine->setFlag("CN");
        $chine->setCoffeeQuantity($faker->randomNumber(4));
        $chine->setInhabitants(1400000000);
        $chine->setSurface(9596961);
        $chine->setDescription("Un pays d’Asie de l’Est avec près d’1,4 milliard d’habitants, elle est connu pour être le pays le plus peuplé du monde.<br> Aussi connu comme la première puissance économique, ce n’est pas étonnant que ce pays soit l’un de 20 plus grands producteurs du café du monde.<br> La culture moderne du café en Chine a commencé en 1988, et 98% du café cultivé provient de la province du Yunnan.<br>");

        $manager->persist($chine);
        array_push($countries, $chine);

        $ouganda = new Country();

        $ouganda->setName("Ouganda");
        $ouganda->setCapital("Kampala");
        $ouganda->setFlag("UG");
        $ouganda->setCoffeeQuantity($faker->randomNumber(4));
        $ouganda->setInhabitants(41100000);
        $ouganda->setSurface(241550);
        $ouganda->setDescription("Un pays avec la principale exportation de café. <br>L’Ouganda est un pays d’Afrique de l’Est faisant partie de l’Afrique des Grands Lacs, tirant son nom de l’ancien royaume de Buganda.<br> Son climat largement équatorial permet de cultiver du café.<br> Certains fermiers de ce pays cultivent le cacaoyer sur des terres produisant déjà du café robusta, poussant naturellement dans les environs de la forêt de Kibale. <br>");

        $manager->persist($ouganda);
        array_push($countries, $ouganda);

        $honduras = new Country();

        $honduras->setName("Honduras");
        $honduras->setCapital("Tegucigalpa");
        $honduras->setFlag("HN");
        $honduras->setCoffeeQuantity($faker->randomNumber(4));
        $honduras->setInhabitants(9100000);
        $honduras->setSurface(112090);
        $honduras->setDescription("Ce magnifique pays qui se situe en Amérique centrale compte de nombreuses îles, cayes et <br> îlots qui était habité par des peuples autochtones, par exemple les Lencas, les Chortis ou les <br> Pech. La culture de café commença fin du XIXème siècle, or sa production de café joue un <br> rôle très important pour la croissance de ce pays, d’où il est le plus grand producteur de café <br> de l’amérique centrale.");

        $manager->persist($honduras);
        array_push($countries, $honduras);

        $ethiopie = new Country();

        $ethiopie->setName("Ethiopie");
        $ethiopie->setCapital("Addis Ababa");
        $ethiopie->setFlag("ET");
        $ethiopie->setCoffeeQuantity($faker->randomNumber(4));
        $ethiopie->setInhabitants(102400000);
        $ethiopie->setSurface(1127127);
        $ethiopie->setDescription("Deuxième pays d’Afrique par sa population. Ethiopie est un État de la Corne de l’Afrique. Ce <br> pays possède un environnement très diversifié et traversé par six zones climatiques. Le café  <br> arabica a pour origine ce pays, où la caféiculture en Éthiopie est une ancienne tradition. La <br> culture du café dans le pays occupe une superficie de 400 000 hectares et la production <br> totale tourne autour de 230 000 tonnes par an. L’économie éthiopienne dépend beaucoup de <br> la production et de la commercialisation du café, au point qu’ils furent un monopole d’État <br> sous le régime marxiste.");

        $manager->persist($ethiopie);
        array_push($countries, $ethiopie);

        $perou = new Country();

        $perou->setName("Perou");
        $perou->setCapital("Lima");
        $perou->setFlag("PE");
        $perou->setCoffeeQuantity($faker->randomNumber(4));
        $perou->setInhabitants(32300000);
        $perou->setSurface(1285315);
        $perou->setDescription("Le Pérou, ou en quechua Piruw Republika, se situe dans l’Ouest de l’Amérique du Sud. Il est <br> le troisième plus grand pays du sous-continent par sa superficie qui atteint plus de 1,2 million <br> de km2. Ce pays est aussi connu pour sa valeur historique, où Cuzco est sa capitale <br>historique. Il existe trois langues officielles aux Pérou: la plus parlée est l’espagnol, suivie du <br>quechua et de l’aymara. Le Pérou est classé comme l’un des 20 premiers producteurs de <br> café dans le monde.");

        $manager->persist($perou);
        array_push($countries, $perou);

        $guatemala = new Country();

        $guatemala->setName("Guatemala");
        $guatemala->setCapital("Guatemala City");
        $guatemala->setFlag("GT");
        $guatemala->setCoffeeQuantity($faker->randomNumber(4));
        $guatemala->setInhabitants(16600000);
        $guatemala->setSurface(108890);
        $guatemala->setDescription("Ce pays vient aussi de l’Amérique centrale, qui fait partie aussi de l’Amérique latine. Son nom <br> en Nahuati se traduit par “lieu rempli d’arbres”.  La valeur historique de ce pays est toujours <br> conservée sous forme de sa monnaie nationale “quetzal”, faisant référence à l’oiseau sacré <br> par les Mayas. La culture caféière au Guatemala représente une part importante de <br> l’économie nationale.");

        $manager->persist($guatemala);
        array_push($countries, $guatemala);

        $mexique = new Country();

        $mexique->setName("Mexique");
        $mexique->setCapital("Mexico");
        $mexique->setFlag("MX");
        $mexique->setCoffeeQuantity($faker->randomNumber(4));
        $mexique->setInhabitants(126000000);
        $mexique->setSurface(1964375);
        $mexique->setDescription("Il se situe dans la partie méridionale de l’Amérique du Nord. Le Mexique est un pays unique <br> qui fait partie des vingt premières puissances économiques mondiales. Plus de 98% de sa  <br> population parlent l’espagnol mexicain, et plus de 6% parlent une langue indigène reconnu <br> comme sa langue nationale. Sa puissance économique fait que la caféiculture au Mexique <br> représente la huitième production mondiale de café au monde, concentrée dans les régions <br> du sud et du sud-est du pays. Sa production de café le plus populaire est majoritairement de <br> l’arabica.");

        $manager->persist($mexique);
        array_push($countries, $mexique);

        for($i = 0; $i < 20; $i++){

            shuffle($exportateurs);

            $coffe = new Coffee();

            $coffe->setCoffeeType($faker->country . " " . $faker->company);
            $coffe->setQuantity($faker->randomNumber(4));
            $coffe->setAccount($exportateurs[0]);

            for($j = 0; $j < 5; $j++){

                shuffle($countries);
                $coffe->addCountry($countries[0]);

            }

            $manager->persist($coffe);

        }

        $manager->flush();
    }
}
