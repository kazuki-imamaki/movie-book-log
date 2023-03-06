import { useState } from "react";
import { router } from "@inertiajs/react";

const AddModal = (props: any) => {
    // console.log(props);
    const closeModal = () => {
        props.setShowModal(false);
    };

    const [postData, setPostData] = useState({
        title: "",
        memo: "",
        userId: props.auth.user.id,
        is_done: 0,
    });

    const onSubmit = () => {
        const url = route("want.movie.create");

        router.post(url, postData);

        closeModal();
    };

    const searchImages = () => {
        // console.log(postData.title);

        const url = route("want.movie.search");

        router.post(url, postData);
    };
    return (
        <>
            {props.showFlag ? (
                <div className="fixed top-0 left-0 right-0 w-hull h-full flex items-center justify-center bg-black bg-opacity-70">
                    <div className="bg-white m-10 p-10 rounded">
                        <p>This is ModalContent</p>
                        <button onClick={closeModal}>close</button>
                        <div className="flex flex-col">
                            <div>
                                <input
                                    type="text"
                                    onChange={(e) =>
                                        setPostData({
                                            ...postData,
                                            title: e.target.value,
                                        })
                                    }
                                />
                                <button type="button" onClick={searchImages}>
                                    <i className="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                            <textarea
                                onChange={(e) =>
                                    setPostData({
                                        ...postData,
                                        memo: e.target.value,
                                    })
                                }
                            ></textarea>
                        </div>
                        <button type="button" onClick={onSubmit}>
                            登録
                        </button>
                    </div>
                </div>
            ) : (
                <></>
            )}
        </>
    );
};

export default AddModal;
