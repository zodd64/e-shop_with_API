package com.staxrt.tutorial.repository;

import com.staxrt.tutorial.model.Product;
import com.staxrt.tutorial.model.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

/**
 * The interface Product repository.
 *
 * @author 4402
 */
@Repository
public interface ProductRepository extends JpaRepository<Product, Long> {
}
