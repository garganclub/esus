<?php

namespace Produits\ProduitsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Produits\ProduitsBundle\Entity\Tva;
use Produits\ProduitsBundle\Form\TvaType;

/**
 * Tva controller.
 *
 */
class TvaController extends Controller
{

    /**
     * Lists all Tva entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ProduitsBundle:Tva')->findAll();

        return $this->render('ProduitsBundle:Tva:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tva entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tva();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tva_show', array('id' => $entity->getId())));
        }

        return $this->render('ProduitsBundle:Tva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tva entity.
     *
     * @param Tva $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tva $entity)
    {
        $form = $this->createForm(new TvaType(), $entity, array(
            'action' => $this->generateUrl('admin_tva_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tva entity.
     *
     */
    public function newAction()
    {
        $entity = new Tva();
        $form   = $this->createCreateForm($entity);

        return $this->render('ProduitsBundle:Tva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tva entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProduitsBundle:Tva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ProduitsBundle:Tva:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tva entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProduitsBundle:Tva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tva entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ProduitsBundle:Tva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tva entity.
    *
    * @param Tva $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tva $entity)
    {
        $form = $this->createForm(new TvaType(), $entity, array(
            'action' => $this->generateUrl('admin_tva_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Tva entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProduitsBundle:Tva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tva_edit', array('id' => $id)));
        }

        return $this->render('ProduitsBundle:Tva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tva entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ProduitsBundle:Tva')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tva entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_tva'));
    }

    /**
     * Creates a form to delete a Tva entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tva_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
