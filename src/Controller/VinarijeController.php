<?php namespace App\Controller;

use App\Entity\Vinarije;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvents;


use Cocur\Slugify\Slugify;
use Twig\Extra\String\StringExtension;

class VinarijeController extends Controller {
    
    /**
     * @Route("/vinarije")
     */
    public function index() {

        $vinarije = $this->getDoctrine()->getRepository(Vinarije::class)->findAll();

        return $this->render('vinarije/index.html.twig', array('vinarije' => $vinarije));
    }

    /**
	 * @Route("/vinarije/new", name="new_vino")
	 * Method({"GET", "POST"})
	 */
	public function new(Request $request) {
		$vinarija = new Vinarije();

		$form = $this->createFormBuilder($vinarija)->add('ime', TextType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('opis', TextareaType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('adresa', TextType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('tel', TextType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('email', TextType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('sajt', TextType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('facebook', TextType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('instagram', TextType::class, array('attr' => array('class' => 'form-control')))
                                               ->add('slika', FileType::class)
                                               ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-success mt-3')))
                                                ->getForm();
		
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
                        $slugify = new Slugify();
                        
                        $filename = $form->get('slika')->getData();
                        $fileSlog = sha1(random_bytes(14)).'.'.$filename->guessExtension();
                        $filename->move(
                            $this->getParameter('file_directory'),
                        $fileSlog
                        );
                        $vinarija->setSlika($fileSlog);
                        
                        $imeVinarije = $form->get('ime')->getData();
                        $imeVinarijeSlug = $slugify->slugify($imeVinarije);
                        
                        $vinarija->setSlug($imeVinarijeSlug);
                        //$vino = $form->getData();
           
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($vinarija);
			$entityManager->flush();

			return $this->redirect('/vinarije');
		}
		
		return $this->render('vinarije/new.html.twig', array(
			'form' => $form->createView()
		));
	}
    
    /**
     * @Route("/vinarije/{slug}")
     */
    public function show($slug) {
        $vinarija = $this->getDoctrine()->getRepository(Vinarije::class)->findOneBy(array('slug' => $slug));

        return $this->render('vinarije/show.html.twig', array('vinarija' => $vinarija));
    }
    
    
    /**
     * @Route("/vinarije/save")
     */

    /*
    public function save() {
        $entityManager = $this->getDoctrine()->getManager();

        $slugify = new Slugify();
        $imeVinarije = 'Podrum Milojević';
        $imeVinarijeSlug = $slugify->slugify($imeVinarije);
        $opis = 'U delu opštine Lazarevac, u selu Zeoke gde se pitoma Kolubara susreće sa brdovitom Šumadijom nalazi se podrum „Milojević“. Padine zeočkih brda čuvaju viševekovnu tradiciju vinogradarstva ovog kraja. Porodica Milojević, se prema pisanim podacima Arhiva Srbije, vinogradarstvom bavi od 1863. godine kada je posedovala tri motike vinograda (jedna motika je posedovala površinu koju jedan kopač za dan okopa). Tradicija uzgajanja groždja, kalemljenja sadnica i proizvodnje vina su se od tada prenosila sa kolena na koleno do danas. Brigu o očuvanju istorisjkog značaja vinogradarstva-Lazarevca, podrum „Milojević“ deli sa članovima udruženja „Zeočki vinogradi“ i svim istinskim ljubiteljima vina. Danas podrum Milojević poseduje gotovo tri hektara vinograda u kome su zastupljene stone sorte "muskat hamburg, muskat italija, afuz ali i cardina" , kao i vinske sorte "vranac, kaberne sovinjon, šardone i smederevka". Na tradicionalan način se od probranog grožđa pripremaju i proizvode ova vina. Iskustvo stečeno vekovima, duh prošlosti i ljubav prema vinogradarstvu pretočena su u naša vina: "Vranac, Kaberne Sovinjon, Kaberne Sovinjon Barik, Hamburg, Smederevka i Šardone". Pored ovih vina proizvodi se i domaće rakije: " Lozovača, Komovica i Šljivovica". Turistički deo predstavlja degustaciona sala u kojoj će Vas naš domaćin dočekati pričom o proizvodnji vina i tradiciji zeočkih vinograda. Mala degustaciona sala sa 40-tak mesta je urađena u etno stilu sa kombinacijom cigle i drveta. Tu se mogu organizovati razne degustacije naših vina sa pratećim gurmanskim specijalitetima koji su pripremljeni kod nas, kao sto su hleb iz furune , kajmak, pršute , razne vrste mesa, sireva i dr. ';

        $vinarije = new Vinarije();
        $vinarije->setIme($imeVinarije);
        $vinarije->setSlug($imeVinarijeSlug);
        $vinarije->setOpis($opis);
        $vinarije->setAdresa('11565 Zeoke-Lazarevac, Srbija');
        $vinarije->setTel('065/815-88-95');
        $vinarije->setEmail('podrummilojevic@gmail.com');
        $vinarije->setSajt('http://www.podrummilojevic.rs');    
        $vinarije->setFacebook('https://www.facebook.com/podrum.milojevic');
        $vinarije->setInstagram('');

        $entityManager->persist($vinarije);

        $entityManager->flush();

        return new Response('Save an vinarija with id of: '.$vinarije->getId());
    } */
}