<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\SearchPointsForm;
use App\InPost\Point\Filter\FilterFacade;
use App\InPost\Point\PointRepository;
use App\InPost\Shared\Filter\Filters;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    public function __construct(
        private readonly PointRepository $pointRepository,
        private readonly FilterFacade $filterFacade,
    ) {}

    #[Route(path: '/search', name: 'search', methods: ['GET', 'POST'])]
    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(SearchPointsForm::class);
        $form->handleRequest($request);

        $results = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $filters = Filters::of($this->filterFacade->createCityFilter($data['city']));
            $points = $this->pointRepository->findWithFilters($filters);
            $results = $points->toArray();
        }

        return $this->render('search.html.twig', [
            'form' => $form->createView(),
            'results' => $results,
        ]);
    }
}
