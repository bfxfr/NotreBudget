<?php

namespace Bfxmpl\Bundle\BudgetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bfxmpl\Bundle\BudgetBundle\Entity\CompteComptable;
use Bfxmpl\Bundle\BudgetBundle\Form\CompteComptableType;

/**
 * CompteComptable controller.
 *
 * @Route("/comptecomptable")
 */
class CompteComptableController extends Controller
{

    /**
     * Lists all CompteComptable entities.
     *
     * @Route("/", name="comptecomptable")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BfxmplBudgetBundle:CompteComptable')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CompteComptable entity.
     *
     * @Route("/", name="comptecomptable_create")
     * @Method("POST")
     * @Template("BfxmplBudgetBundle:CompteComptable:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CompteComptable();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comptecomptable_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CompteComptable entity.
     *
     * @param CompteComptable $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompteComptable $entity)
    {
        $form = $this->createForm(new CompteComptableType(), $entity, array(
            'action' => $this->generateUrl('comptecomptable_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new CompteComptable entity.
     *
     * @Route("/new", name="comptecomptable_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompteComptable();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CompteComptable entity.
     *
     * @Route("/{id}", name="comptecomptable_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BfxmplBudgetBundle:CompteComptable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Impossible de trouver CompteComptable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CompteComptable entity.
     *
     * @Route("/{id}/edit", name="comptecomptable_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BfxmplBudgetBundle:CompteComptable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Impossible de trouver CompteComptable entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a CompteComptable entity.
    *
    * @param CompteComptable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompteComptable $entity)
    {
        $form = $this->createForm(new CompteComptableType(), $entity, array(
            'action' => $this->generateUrl('comptecomptable_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing CompteComptable entity.
     *
     * @Route("/{id}", name="comptecomptable_update")
     * @Method("PUT")
     * @Template("BfxmplBudgetBundle:CompteComptable:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BfxmplBudgetBundle:CompteComptable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Impossible de trouver CompteComptable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('comptecomptable_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CompteComptable entity.
     *
     * @Route("/{id}", name="comptecomptable_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BfxmplBudgetBundle:CompteComptable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Impossible de trouver CompteComptable entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comptecomptable'));
    }

    /**
     * Creates a form to delete a CompteComptable entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comptecomptable_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer'))
            ->getForm()
        ;
    }
}
