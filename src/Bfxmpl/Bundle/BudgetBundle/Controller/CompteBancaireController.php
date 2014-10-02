<?php

namespace Bfxmpl\Bundle\BudgetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bfxmpl\Bundle\BudgetBundle\Entity\CompteBancaire;
use Bfxmpl\Bundle\BudgetBundle\Form\Type\CompteBancaireType;

/**
 * CompteBancaire controller.
 *
 * @Route("/comptebancaire")
 */
class CompteBancaireController extends Controller
{

    /**
     * Lists all CompteBancaire entities.
     *
     * @Route("/", name="comptebancaire")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BfxmplBudgetBundle:CompteBancaire')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new CompteBancaire entity.
     *
     * @Route("/", name="comptebancaire_create")
     * @Method("POST")
     * @Template("BfxmplBudgetBundle:CompteBancaire:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CompteBancaire();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comptebancaire_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CompteBancaire entity.
     *
     * @param CompteBancaire $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompteBancaire $entity)
    {
        $form = $this->createForm(new CompteBancaireType(), $entity, array(
            'action' => $this->generateUrl('comptebancaire_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
     * Displays a form to create a new CompteBancaire entity.
     *
     * @Route("/new", name="comptebancaire_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompteBancaire();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CompteBancaire entity.
     *
     * @Route("/{id}", name="comptebancaire_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BfxmplBudgetBundle:CompteBancaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompteBancaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CompteBancaire entity.
     *
     * @Route("/{id}/edit", name="comptebancaire_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BfxmplBudgetBundle:CompteBancaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Impossible de trouver CompteBancaire entity.');
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
    * Creates a form to edit a CompteBancaire entity.
    *
    * @param CompteBancaire $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompteBancaire $entity)
    {
        $form = $this->createForm(new CompteBancaireType(), $entity, array(
            'action' => $this->generateUrl('comptebancaire_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }

    /**
     * Edits an existing CompteBancaire entity.
     *
     * @Route("/{id}", name="comptebancaire_update")
     * @Method("PUT")
     * @Template("BfxmplBudgetBundle:CompteBancaire:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BfxmplBudgetBundle:CompteBancaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Impossible de trouver CompteBancaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('comptebancaire_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a CompteBancaire entity.
     *
     * @Route("/{id}", name="comptebancaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BfxmplBudgetBundle:CompteBancaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Impossible de trouver CompteBancaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comptebancaire'));
    }

    /**
     * Creates a form to delete a CompteBancaire entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comptebancaire_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer'))
            ->getForm()
        ;
    }
}
