package com.staxrt.tutorial.repository;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Query;
import java.util.List;

@Repository
public class MyOrdersRepository {
    @Autowired
    private final EntityManagerFactory emf;

    public MyOrdersRepository(EntityManagerFactory emf) {
        this.emf = emf;
    }
    public List<Object[]> find(Long uid) {
        EntityManager entityManager = emf.createEntityManager();
        Query query = (Query) entityManager
                .createQuery("SELECT p, o FROM  Product p, Order o"
                        + " WHERE p.pid = o.pid AND o.uid=:uid ORDER BY o.date DESC");
        query.setParameter("uid", uid);

        return query.getResultList();
    }
}
